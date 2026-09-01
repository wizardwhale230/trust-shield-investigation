@extends('layouts.dashboard')
@section('title', $title)
@section('page-title', 'Identity Verification')

@section('content')
    <x-danger-alert />
    <x-success-alert />
    <x-error-alert />

    <div class="max-w-4xl mx-auto">
        <div class="mb-6 text-center">
            <h2 class="text-lg font-heading font-semibold text-content">Begin your identity verification</h2>
            <p class="text-sm text-content-secondary mt-0.5">
                Verification helps protect your account and supports a secure fraud recovery process.
            </p>
        </div>

        <div class="dash-card">
            <form action="{{ route('kycsubmit') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <h3 class="text-sm font-semibold text-content">Personal Details</h3>
                    <p class="text-xs text-content-tertiary mt-1">Please fill with accurate information. Submitted details cannot be edited later.</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label for="firstname" class="form-label">First name <span class="text-danger">*</span></label>
                            <input type="text" name="first_name" class="input-field" required>
                        </div>
                        <div>
                            <label for="lastname" class="form-label">Last name <span class="text-danger">*</span></label>
                            <input type="text" name="last_name" class="input-field" required>
                        </div>
                        <div>
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="input-field" required>
                        </div>
                        <div>
                            <label for="phone_number" class="form-label">Phone Number <span class="text-danger">*</span></label>
                            <input type="text" name="phone_number" class="input-field" required>
                        </div>
                        <div>
                            <label for="dob" class="form-label">Date of birth <span class="text-danger">*</span></label>
                            <input type="date" name="dob" class="input-field" data-toggle="date" placeholder="Select date" required>
                        </div>
                        <div>
                            <label for="social_media" class="form-label">Twitter or Facebook username</label>
                            <input type="text" name="social_media" class="input-field">
                        </div>
                    </div>
                </div>

                <div class="border-t border-border-muted pt-6">
                    <h3 class="text-sm font-semibold text-content">Address Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label for="address" class="form-label">Address line <span class="text-danger">*</span></label>
                            <input type="text" name="address" class="input-field" required>
                        </div>
                        <div>
                            <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                            <input type="text" name="city" class="input-field" required>
                        </div>
                        <div>
                            <label for="state" class="form-label">State <span class="text-danger">*</span></label>
                            <input type="text" name="state" class="input-field" required>
                        </div>
                        <div>
                            <label for="country" class="form-label">Nationality <span class="text-danger">*</span></label>
                            <input type="text" name="country" class="input-field" required>
                        </div>
                    </div>
                </div>

                <div class="border-t border-border-muted pt-6">
                    <h3 class="text-sm font-semibold text-content">Document Upload</h3>
                    <p class="text-xs text-content-tertiary mt-1">Upload valid and clearly visible identity documents.</p>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mt-4">
                        <label class="cursor-pointer border border-border rounded-md p-3 text-sm text-content hover:border-primary transition-colors">
                            <input type="radio" name="document_type" value="Int'l Passport" class="mr-2" checked>
                            Int'l Passport
                        </label>
                        <label class="cursor-pointer border border-border rounded-md p-3 text-sm text-content hover:border-primary transition-colors">
                            <input type="radio" name="document_type" value="National ID" class="mr-2">
                            National ID
                        </label>
                        <label class="cursor-pointer border border-border rounded-md p-3 text-sm text-content hover:border-primary transition-colors">
                            <input type="radio" name="document_type" value="Drivers License" class="mr-2">
                            Drivers License
                        </label>
                    </div>

                    <ul class="mt-4 text-xs text-content-secondary space-y-1 list-disc pl-5">
                        <li>Chosen document must not be expired.</li>
                        <li>Document should be in good condition and clearly visible.</li>
                        <li>Avoid glare and blur in uploaded images.</li>
                    </ul>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="form-label">Upload front side <span class="text-danger">*</span></label>
                            <input type="file" name="frontimg" class="input-field" required>
                        </div>
                        <div>
                            <label class="form-label">Upload back side <span class="text-danger">*</span></label>
                            <input type="file" name="backimg" class="input-field" required>
                        </div>
                    </div>
                </div>

                <div class="border-t border-border-muted pt-6">
                    <label class="inline-flex items-center gap-2 text-sm text-content mb-4">
                        <input class="w-4 h-4 text-primary border-border focus:ring-primary" type="checkbox" value="" id="defaultCheck1" required>
                        <span>All the information I entered is correct.</span>
                    </label>

                    @if (Auth::user()->account_verify == 'Under review')
                        <button type="submit" class="btn-secondary opacity-70 cursor-not-allowed" disabled>Submit Application</button>
                        <p class="text-xs text-success mt-2">Your previous application is under review, please wait.</p>
                    @else
                        <button type="submit" class="btn-primary">Submit Application</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
@endsection
