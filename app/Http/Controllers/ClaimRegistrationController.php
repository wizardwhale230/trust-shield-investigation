<?php

namespace App\Http\Controllers;

use App\Helpers\SafeMail;
use App\Mail\CaseFiled;
use App\Models\CaseDocument;
use App\Models\FraudCase;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ClaimRegistrationController extends Controller
{
    /**
     * Submit a claim and register a new user (or file for existing user).
     */
    public function submitClaimWithRegistration(Request $request)
    {
        $isGuest = !Auth::check();

        // Base validation for claim fields
        $rules = [
            'fraud_type' => 'required|string|max:255',
            'amount_lost' => 'required|string|max:255',
            'timeframe' => 'required|string|max:255',
            'description' => 'nullable|string|max:5000',
            'documents.*' => 'nullable|file|max:10240|mimes:jpg,jpeg,png,gif,pdf,doc,docx,xls,xlsx,txt',
        ];

        // Registration fields required only for guests
        if ($isGuest) {
            $rules['name'] = 'required|string|max:255';
            $rules['email'] = 'required|email|max:255|unique:users,email';
            $rules['phone'] = 'required|string|max:50';
            $rules['country'] = 'required|string|max:255';
            $rules['password'] = 'required|string|min:6|confirmed';
        }

        $validated = $request->validate($rules);

        $settings = Settings::where('id', 1)->first();

        DB::beginTransaction();

        try {
            // Create user if guest
            if ($isGuest) {
                $username = Str::slug($validated['name'], '') . rand(100, 999);

                $user = new User();
                $user->name = $validated['name'];
                $user->email = $validated['email'];
                $user->phone = $validated['phone'];
                $user->country = $validated['country'];
                $user->password = Hash::make($validated['password']);
                $user->username = $username;
                $user->status = 'active';
                $user->dashboard_style = 'dark';
                $user->account_bal = 0;
                $user->roi = 0;
                $user->bonus = 0;
                $user->ref_bonus = 0;
                $user->email_verified_at = now();
                $user->save();
            } else {
                $user = Auth::user();
            }

            // Create fraud case
            $case = FraudCase::create([
                'case_number' => FraudCase::generateCaseNumber(),
                'user_id' => $user->id,
                'status' => 'new',
                'fraud_type' => $validated['fraud_type'],
                'amount_lost' => $validated['amount_lost'],
                'timeframe' => $validated['timeframe'],
                'description' => $validated['description'] ?? null,
                'priority' => 'medium',
            ]);

            // Handle document uploads
            if ($request->hasFile('documents')) {
                foreach ($request->file('documents') as $file) {
                    $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('case-documents/' . $case->id, $filename, 'public');

                    CaseDocument::create([
                        'case_id' => $case->id,
                        'user_id' => $user->id,
                        'filename' => $filename,
                        'original_name' => $file->getClientOriginalName(),
                        'file_path' => $path,
                        'file_type' => $file->getClientMimeType(),
                        'file_size' => $file->getSize(),
                        'uploaded_by' => 'user',
                    ]);
                }
            }

            DB::commit();

            // Send confirmation to claimant and alert to admin — transport failure must not block claim filing
            SafeMail::send(fn() => Mail::to($user->email)->send(new CaseFiled($case, $user, false)), ['case_id' => $case->id, 'user_id' => $user->id]);
            SafeMail::send(fn() => Mail::to($settings->contact_email)->send(new CaseFiled($case, $user, true)), ['case_id' => $case->id]);

            // Auto-login if new user
            if ($isGuest) {
                Auth::login($user);
            }

            return redirect()->route('dashboard')
                ->with('success', 'Your case ' . $case->case_number . ' has been filed successfully. Our team will review it shortly.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('status', 'Something went wrong. Please try again.');
        }
    }
}
