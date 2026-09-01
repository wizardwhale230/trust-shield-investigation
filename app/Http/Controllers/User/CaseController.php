<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\FraudCase;
use App\Models\CaseDocument;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CaseController extends Controller
{
    public function index(Request $request)
    {
        $query = FraudCase::where('user_id', Auth::id());

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('fraud_type')) {
            $query->where('fraud_type', $request->fraud_type);
        }

        $settings = Settings::find(1);

        return view('user.cases.index', [
            'title' => 'My Cases',
            'cases' => $query->orderByDesc('id')->paginate(15),
            'currency' => $settings->currency ?? '$',
            'settings' => $settings,
        ]);
    }

    public function show(FraudCase $fraudCase)
    {
        if ($fraudCase->user_id !== Auth::id()) {
            abort(403);
        }

        $fraudCase->load('assignedTo');
        $settings = Settings::find(1);

        return view('user.cases.show', [
            'case' => $fraudCase,
            'notes' => $fraudCase->visibleNotes()->with('author')->orderBy('created_at')->get(),
            'documents' => $fraudCase->documents()->orderByDesc('created_at')->get(),
            'feeRequests' => $fraudCase->feeRequests()->orderByDesc('created_at')->get(),
            'currency' => $settings->currency ?? '$',
            'settings' => $settings,
        ]);
    }

    public function create()
    {
        $settings = Settings::find(1);

        return view('user.cases.create', [
            'title' => 'File New Case',
            'currency' => $settings->currency ?? '$',
            'settings' => $settings,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'fraud_type' => 'required|in:cryptocurrency,forex,binary_options,romance,investment,other',
            'amount_lost' => 'required|numeric|min:0',
            'timeframe' => 'required|in:less_than_month,1_3_months,3_6_months,6_12_months,over_year',
            'description' => 'required|string|min:20',
            'documents.*' => 'nullable|file|max:10240|mimes:jpg,jpeg,png,gif,pdf,doc,docx,xls,xlsx,txt',
        ]);

        $case = FraudCase::create([
            'case_number' => FraudCase::generateCaseNumber(),
            'user_id' => Auth::id(),
            'fraud_type' => $request->fraud_type,
            'amount_lost' => $request->amount_lost,
            'timeframe' => $request->timeframe,
            'description' => $request->description,
            'status' => 'new',
        ]);

        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $path = $file->store('case-documents/' . $case->id, 'public');
                CaseDocument::create([
                    'case_id' => $case->id,
                    'user_id' => Auth::id(),
                    'filename' => basename($path),
                    'original_name' => $file->getClientOriginalName(),
                    'file_path' => $path,
                    'file_type' => $file->getMimeType(),
                    'file_size' => $file->getSize(),
                    'uploaded_by' => 'user',
                ]);
            }
        }

        return redirect()->route('user.cases.show', $case)
            ->with('success', 'Your case has been filed successfully. Case number: ' . $case->case_number);
    }

    public function uploadDocument(Request $request, FraudCase $fraudCase)
    {
        if ($fraudCase->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'document' => 'required|file|max:10240|mimes:jpg,jpeg,png,gif,pdf,doc,docx,xls,xlsx,txt',
            'description' => 'nullable|string|max:255',
        ]);

        $file = $request->file('document');
        $path = $file->store('case-documents/' . $fraudCase->id, 'public');

        CaseDocument::create([
            'case_id' => $fraudCase->id,
            'user_id' => Auth::id(),
            'filename' => basename($path),
            'original_name' => $file->getClientOriginalName(),
            'file_path' => $path,
            'file_type' => $file->getMimeType(),
            'file_size' => $file->getSize(),
            'description' => $request->description,
            'uploaded_by' => 'user',
        ]);

        return redirect()->route('user.cases.show', $fraudCase)
            ->with('success', 'Document uploaded successfully.');
    }

    public function downloadDocument(FraudCase $fraudCase, CaseDocument $document)
    {
        if ($fraudCase->user_id !== Auth::id() || $document->case_id !== $fraudCase->id) {
            abort(403);
        }

        if (! Storage::disk('public')->exists($document->file_path)) {
            abort(404, 'File not found.');
        }

        return Storage::disk('public')->download($document->file_path, $document->original_name);
    }

    public function assignedMember(FraudCase $fraudCase)
    {
        if ($fraudCase->user_id !== Auth::id()) {
            abort(403);
        }

        if (! $fraudCase->team_member_id) {
            abort(404, 'No team member has been assigned to this case yet.');
        }

        $fraudCase->load('assignedTo');
        $settings = Settings::find(1);

        return view('user.cases.assigned-member', [
            'case'     => $fraudCase,
            'member'   => $fraudCase->assignedTo,
            'currency' => $settings->currency ?? '$',
            'settings' => $settings,
        ]);
    }
}
