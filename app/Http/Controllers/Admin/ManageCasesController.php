<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FraudCase;
use App\Models\CaseNote;
use App\Models\CaseDocument;
use App\Models\FeeRequest;
use App\Models\TeamMember;
use App\Models\User;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Helpers\SafeMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\CaseStatusUpdated;
use App\Mail\RecoveryCredit;
use App\Mail\FeeRequestCreated;

class ManageCasesController extends Controller
{
    public function index(Request $request)
    {
        $query = FraudCase::with('user');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('assigned_to')) {
            $query->where('team_member_id', $request->assigned_to);
        }
        if ($request->filled('fraud_type')) {
            $query->where('fraud_type', $request->fraud_type);
        }

        $settings = Settings::find(1);
        $teamMembers = TeamMember::where('is_active', true)->get();

        return view('admin.Cases.index', [
            'title' => 'Recovery Cases',
            'cases' => $query->orderByDesc('id')->paginate(20),
            'teamMembers' => $teamMembers,
            'newCasesCount' => FraudCase::where('status', 'new')->count(),
            'settings' => $settings,
        ]);
    }

    public function show($id)
    {
        $case = FraudCase::with(['user', 'assignedTo', 'documents', 'feeRequests'])->findOrFail($id);
        $notes = $case->notes()->with('author')->orderBy('created_at', 'desc')->get();
        $teamMembers = TeamMember::where('is_active', true)->get();
        $settings = Settings::find(1);

        return view('admin.Cases.show', [
            'title' => 'Case ' . $case->case_number,
            'case' => $case,
            'notes' => $notes,
            'teamMembers' => $teamMembers,
            'settings' => $settings,
        ]);
    }

    public function assign(Request $request, $id)
    {
        $request->validate([
            'team_member_id' => 'required|exists:team_members,id',
        ]);

        $case = FraudCase::findOrFail($id);
        $case->update([
            'team_member_id' => $request->team_member_id,
            'status' => $case->status === 'new' ? 'assigned' : $case->status,
        ]);

        $member = TeamMember::find($request->team_member_id);

        CaseNote::create([
            'case_id' => $case->id,
            'author_id' => Auth::guard('admin')->id(),
            'author_type' => 'App\\Models\\Admin',
            'note' => 'Case assigned to ' . $member->full_name,
            'is_internal' => false,
        ]);

        return back()->with('success', 'Case assigned successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:new,assigned,investigating,legal_action,funds_recovered,withdrawal_ready,closed',
        ]);

        $case = FraudCase::findOrFail($id);
        $oldStatus = $case->status;
        $case->update([
            'status' => $request->status,
            'closed_at' => $request->status === 'closed' ? now() : $case->closed_at,
        ]);

        CaseNote::create([
            'case_id' => $case->id,
            'author_id' => Auth::guard('admin')->id(),
            'author_type' => 'App\\Models\\Admin',
            'note' => 'Status changed from "' . ucwords(str_replace('_', ' ', $oldStatus)) . '" to "' . ucwords(str_replace('_', ' ', $request->status)) . '"',
            'is_internal' => false,
        ]);

        $user = User::find($case->user_id);
        if ($user) {
            SafeMail::send(fn() => Mail::to($user->email)->send(new CaseStatusUpdated($case, $user, $oldStatus)), ['case_id' => $case->id, 'user_id' => $user->id]);
        }

        return back()->with('success', 'Case status updated.');
    }

    public function addNote(Request $request, $id)
    {
        $request->validate([
            'note' => 'required|string|min:2',
            'is_internal' => 'nullable|boolean',
        ]);

        $case = FraudCase::findOrFail($id);

        CaseNote::create([
            'case_id' => $case->id,
            'author_id' => Auth::guard('admin')->id(),
            'author_type' => 'App\\Models\\Admin',
            'note' => $request->note,
            'is_internal' => $request->boolean('is_internal'),
        ]);

        return back()->with('success', 'Note added successfully.');
    }

    public function creditRecovery(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
        ]);

        $case = FraudCase::findOrFail($id);

        DB::transaction(function () use ($case, $request) {
            $case->update([
                'amount_recovered' => $case->amount_recovered + $request->amount,
                'status' => 'funds_recovered',
            ]);

            User::where('id', $case->user_id)->increment('account_bal', $request->amount);

            CaseNote::create([
                'case_id' => $case->id,
                'author_id' => Auth::guard('admin')->id(),
                'author_type' => 'App\\Models\\Admin',
                'note' => 'Recovered ' . (Settings::find(1)->currency ?? '$') . number_format($request->amount, 2) . ' credited to client account.',
                'is_internal' => false,
            ]);
        });

        return back()->with('success', 'Recovery amount credited to client.');
    }

    public function createFeeRequest($id)
    {
        $case = FraudCase::with('user')->findOrFail($id);
        $settings = Settings::find(1);

        return view('admin.Cases.create-fee', [
            'title' => 'Create Fee Request',
            'case' => $case,
            'settings' => $settings,
        ]);
    }

    public function storeFeeRequest(Request $request)
    {
        $request->validate([
            'case_id' => 'required|exists:fraud_cases,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $case = FraudCase::findOrFail($request->case_id);

        FeeRequest::create([
            'case_id' => $case->id,
            'user_id' => $case->user_id,
            'requested_by' => Auth::guard('admin')->id(),
            'title' => $request->title,
            'description' => $request->description,
            'amount' => $request->amount,
            'status' => 'pending',
        ]);

        return redirect()->route('admin.cases.show', $case->id)
            ->with('success', 'Fee request created.');
    }

    public function downloadDocument($id, CaseDocument $document)
    {
        if ($document->case_id !== (int) $id) {
            abort(403);
        }

        if (! Storage::disk('public')->exists($document->file_path)) {
            abort(404, 'File not found.');
        }

        return Storage::disk('public')->download($document->file_path, $document->original_name);
    }

    public function cancelFeeRequest($id)
    {
        $fee = FeeRequest::findOrFail($id);

        if ($fee->status !== 'pending') {
            return back()->with('message', 'Only pending fee requests can be cancelled.');
        }

        $fee->update(['status' => 'cancelled']);

        return back()->with('success', 'Fee request cancelled.');
    }
}
