@extends('layouts.dashboard')
@section('title', 'File a New Claim')
@section('page-title', 'File a New Claim')

@section('content')
    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm mb-6">
        <a href="{{ route('user.cases.index') }}" class="text-content-tertiary hover:text-content transition-colors">Matters</a>
        <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-content-tertiary"></i>
        <span class="text-content font-medium">File a new claim</span>
    </nav>

    {{-- Header band --}}
    <div class="mb-6 pb-5 border-b border-border-muted">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
            <div>
                <p class="text-xs uppercase tracking-widest text-accent font-semibold mb-2">Confidential intake</p>
                <h2 class="text-xl sm:text-2xl font-heading font-semibold text-content">File a new recovery claim</h2>
                <p class="text-sm text-content-secondary mt-1 max-w-2xl">Provide the details of the incident so our intake team can open a matter and assign counsel. All submissions are reviewed under strict client confidentiality.</p>
            </div>
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-success-light text-success text-xs font-medium self-start">
                <i data-lucide="shield-check" class="w-3.5 h-3.5"></i>
                Encrypted submission
            </span>
        </div>
        <div class="mt-4 h-px w-16 bg-accent"></div>
    </div>

    <div class="max-w-2xl">
        <div class="dash-card border-l-4 border-primary">
            <div class="mb-6">
                <h2 class="text-base font-heading font-semibold text-content">Matter intake form</h2>
                <p class="text-sm text-content-secondary mt-1">Complete every required field. Counsel will be in touch within 24 hours of submission.</p>
            </div>

            @if($errors->any())
                <div class="mb-6 p-4 bg-danger-light border border-danger/20 rounded-md">
                    <div class="flex items-center gap-2 mb-2">
                        <i data-lucide="alert-circle" class="w-4 h-4 text-danger"></i>
                        <p class="text-sm font-medium text-danger">Please fix the following errors:</p>
                    </div>
                    <ul class="list-disc list-inside text-sm text-danger space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('user.cases.store') }}" enctype="multipart/form-data" x-data="{ fraudType: '{{ old('fraud_type', '') }}' }">
                @csrf

                {{-- Fraud Type --}}
                <div class="mb-5">
                    <label class="form-label">Type of Fraud <span class="text-danger">*</span></label>
                    <select name="fraud_type" x-model="fraudType" class="input-field" required>
                        <option value="">Select fraud type</option>
                        <option value="cryptocurrency" {{ old('fraud_type') == 'cryptocurrency' ? 'selected' : '' }}>Cryptocurrency Fraud</option>
                        <option value="forex" {{ old('fraud_type') == 'forex' ? 'selected' : '' }}>Forex Trading Fraud</option>
                        <option value="binary_options" {{ old('fraud_type') == 'binary_options' ? 'selected' : '' }}>Binary Options</option>
                        <option value="romance" {{ old('fraud_type') == 'romance' ? 'selected' : '' }}>Romance Scam</option>
                        <option value="investment" {{ old('fraud_type') == 'investment' ? 'selected' : '' }}>Investment Fraud</option>
                        <option value="other" {{ old('fraud_type') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('fraud_type') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                {{-- Amount Lost --}}
                <div class="mb-5">
                    <label class="form-label">Amount Lost ({{ $currency }}) <span class="text-danger">*</span></label>
                    <input type="number" name="amount_lost" value="{{ old('amount_lost') }}" class="input-field" placeholder="0.00" step="0.01" min="0" required>
                    @error('amount_lost') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                {{-- Timeframe --}}
                <div class="mb-5">
                    <label class="form-label">When did this happen? <span class="text-danger">*</span></label>
                    <select name="timeframe" class="input-field" required>
                        <option value="">Select timeframe</option>
                        <option value="less_than_month" {{ old('timeframe') == 'less_than_month' ? 'selected' : '' }}>Less than 1 month ago</option>
                        <option value="1_3_months" {{ old('timeframe') == '1_3_months' ? 'selected' : '' }}>1-3 months ago</option>
                        <option value="3_6_months" {{ old('timeframe') == '3_6_months' ? 'selected' : '' }}>3-6 months ago</option>
                        <option value="6_12_months" {{ old('timeframe') == '6_12_months' ? 'selected' : '' }}>6-12 months ago</option>
                        <option value="over_year" {{ old('timeframe') == 'over_year' ? 'selected' : '' }}>Over 1 year ago</option>
                    </select>
                    @error('timeframe') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                {{-- Description --}}
                <div class="mb-5">
                    <label class="form-label">Describe what happened <span class="text-danger">*</span></label>
                    <textarea name="description" rows="5" class="input-field" placeholder="Please provide details about the fraud incident, including how you were contacted, what was promised, and any other relevant information." required>{{ old('description') }}</textarea>
                    @error('description') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                {{-- Documents --}}
                <div class="mb-6" x-data="{ files: [] }">
                    <label class="form-label">Supporting Documents (optional)</label>
                    <p class="text-xs text-content-tertiary mb-2">Upload screenshots, bank statements, emails, or other evidence. Max 10MB per file.</p>
                    <input type="file" name="documents[]" multiple
                        @change="files = Array.from($event.target.files)"
                        class="input-field text-sm file:mr-3 file:py-1 file:px-3 file:border-0 file:text-sm file:font-medium file:bg-primary-light file:text-primary file:rounded-md file:cursor-pointer">
                    <template x-if="files.length > 0">
                        <div class="mt-2 space-y-1">
                            <template x-for="file in files" :key="file.name">
                                <div class="flex items-center gap-2 text-xs text-content-secondary">
                                    <i data-lucide="paperclip" class="w-3 h-3"></i>
                                    <span x-text="file.name"></span>
                                    <span class="text-content-tertiary" x-text="'(' + (file.size / 1024).toFixed(0) + ' KB)'"></span>
                                </div>
                            </template>
                        </div>
                    </template>
                    @error('documents.*') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                {{-- Submit --}}
                <div class="flex items-center gap-3 pt-4 border-t border-border-muted">
                    <button type="submit" class="btn-primary">
                        <i data-lucide="send" class="w-4 h-4 mr-1.5"></i>
                        Submit for review
                    </button>
                    <a href="{{ route('user.cases.index') }}" class="btn-ghost">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
