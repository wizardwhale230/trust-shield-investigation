{{-- Claim Wizard Component --}}
@php $isGuest = !auth()->check(); @endphp
<div x-data="claimWizard({{ $isGuest ? 'true' : 'false' }})" class="max-w-2xl mx-auto">
    {{-- Progress bar --}}
    <div class="mb-10">
        <div class="flex items-center justify-between mb-2">
            <span class="text-xs font-medium text-content-secondary" x-text="'Step ' + step + ' of ' + totalSteps"></span>
            <span class="text-xs text-content-tertiary" x-text="Math.round((step / totalSteps) * 100) + '%'"></span>
        </div>
        <div class="w-full h-1 bg-surface-subtle rounded-full overflow-hidden">
            <div class="h-full bg-primary rounded-full transition-all duration-500" :style="'width: ' + ((step / totalSteps) * 100) + '%'"></div>
        </div>
    </div>

    {{-- Server-side errors --}}
    @if ($errors->any())
        <div class="mb-6 bg-surface-subtle border-l-2 border-danger p-4 rounded-r-md">
            <p class="text-sm font-medium text-content mb-1">Please fix the following errors:</p>
            <ul class="list-disc pl-5 text-sm text-content-secondary space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('recovery.claim.submit') }}" enctype="multipart/form-data" x-ref="claimForm">
        @csrf

        {{-- Hidden fields populated by wizard steps --}}
        <input type="hidden" name="fraud_type" x-model="answers.issue">
        <input type="hidden" name="amount_lost" x-model="answers.amount">
        <input type="hidden" name="timeframe" x-model="answers.timeframe">

        {{-- Step 1: Fraud type --}}
        <div x-show="step === 1" x-transition>
            <h3 class="text-xl font-semibold text-content mb-2">What happened to you?</h3>
            <p class="text-sm text-content-secondary mb-6">Select the option that best describes your situation.</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <template x-for="option in fraudTypes" :key="option">
                    <button type="button" @click="answers.issue = option; nextStep()" class="p-4 text-left text-sm font-medium border rounded-lg transition-all hover:border-primary hover:bg-primary-light" :class="answers.issue === option ? 'border-primary bg-primary-light text-primary' : 'border-border text-content-secondary'" x-text="option"></button>
                </template>
            </div>
        </div>

        {{-- Step 2: Amount lost --}}
        <div x-show="step === 2" x-transition>
            <h3 class="text-xl font-semibold text-content mb-2">How much did you lose?</h3>
            <p class="text-sm text-content-secondary mb-6">Select the approximate amount.</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <template x-for="option in amountRanges" :key="option">
                    <button type="button" @click="answers.amount = option; nextStep()" class="p-4 text-left text-sm font-medium border rounded-lg transition-all hover:border-primary hover:bg-primary-light" :class="answers.amount === option ? 'border-primary bg-primary-light text-primary' : 'border-border text-content-secondary'" x-text="option"></button>
                </template>
            </div>
        </div>

        {{-- Step 3: Timeframe --}}
        <div x-show="step === 3" x-transition>
            <h3 class="text-xl font-semibold text-content mb-2">When did this happen?</h3>
            <p class="text-sm text-content-secondary mb-6">Select the timeframe.</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <template x-for="option in timeframes" :key="option">
                    <button type="button" @click="answers.timeframe = option; nextStep()" class="p-4 text-left text-sm font-medium border rounded-lg transition-all hover:border-primary hover:bg-primary-light" :class="answers.timeframe === option ? 'border-primary bg-primary-light text-primary' : 'border-border text-content-secondary'" x-text="option"></button>
                </template>
            </div>
        </div>

        {{-- Step 4: Case details + evidence --}}
        <div x-show="step === 4" x-transition>
            <h3 class="text-xl font-semibold text-content mb-2">Tell us more about your case</h3>
            <p class="text-sm text-content-secondary mb-6">Provide details and any supporting evidence.</p>
            <div class="space-y-4">
                <div>
                    <label for="claim-description" class="block text-sm font-medium text-content mb-1">Describe what happened</label>
                    <textarea id="claim-description" name="description" x-model="answers.description" rows="4" class="input-field" placeholder="Include details such as the company/individual involved, how you were contacted, what happened, and any actions you've already taken..."></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-content mb-1">Supporting documents <span class="text-content-tertiary font-normal">(optional)</span></label>
                    <p class="text-xs text-content-tertiary mb-3">Screenshots, bank statements, contracts, emails — up to 10MB each.</p>
                    <div class="border border-dashed border-border rounded-lg p-6 text-center hover:border-primary transition-colors cursor-pointer" @click="$refs.fileInput.click()">
                        <i data-lucide="upload-cloud" class="w-8 h-8 text-content-tertiary mx-auto mb-2"></i>
                        <p class="text-sm text-content-secondary">Click to upload or drag files here</p>
                        <p class="text-xs text-content-tertiary mt-1">JPG, PNG, PDF, DOC, XLS, TXT</p>
                    </div>
                    <input type="file" name="documents[]" multiple x-ref="fileInput" @change="handleFiles($event)" class="hidden" accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx,.xls,.xlsx,.txt">
                    <div x-show="fileNames.length > 0" class="mt-3 space-y-2">
                        <template x-for="(name, index) in fileNames" :key="index">
                            <div class="flex items-center justify-between py-2 px-3 bg-surface-subtle rounded-md">
                                <span class="text-sm text-content-secondary truncate" x-text="name"></span>
                                <button type="button" @click="removeFile(index)" class="text-content-tertiary hover:text-danger transition-colors flex-shrink-0 ml-2">
                                    <i data-lucide="x" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </template>
                    </div>
                </div>
                <button type="button" @click="nextStep()" class="btn-primary w-full">Continue</button>
            </div>
        </div>

        {{-- Step 5: Create account (guests only) or Submit (logged-in users) --}}
        <div x-show="step === finalStep" x-transition>
            <template x-if="isGuest">
                <div>
                    <h3 class="text-xl font-semibold text-content mb-2">Create your account</h3>
                    <p class="text-sm text-content-secondary mb-6">Set up your account to track your case and receive updates.</p>
                    <div class="space-y-4">
                        <div>
                            <label for="claim-fullname" class="block text-sm font-medium text-content mb-1">Full Name</label>
                            <input type="text" id="claim-fullname" name="name" x-model="answers.name" required class="input-field" placeholder="Your full name">
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="claim-email" class="block text-sm font-medium text-content mb-1">Email</label>
                                <input type="email" id="claim-email" name="email" x-model="answers.email" required class="input-field" placeholder="your@email.com">
                            </div>
                            <div>
                                <label for="claim-phone" class="block text-sm font-medium text-content mb-1">Phone</label>
                                <input type="tel" id="claim-phone" name="phone" x-model="answers.phone" required class="input-field" placeholder="Your phone number">
                            </div>
                        </div>
                        <div>
                            <label for="claim-country" class="block text-sm font-medium text-content mb-1">Country</label>
                            <select id="claim-country" name="country" x-model="answers.country" required class="input-field">
                                <option value="">Select your country</option>
                                @include('auth.countries')
                            </select>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="claim-password" class="block text-sm font-medium text-content mb-1">Password</label>
                                <input type="password" id="claim-password" name="password" x-model="answers.password" required class="input-field" placeholder="Min. 6 characters" minlength="6">
                            </div>
                            <div>
                                <label for="claim-password-confirm" class="block text-sm font-medium text-content mb-1">Confirm Password</label>
                                <input type="password" id="claim-password-confirm" name="password_confirmation" x-model="answers.password_confirmation" required class="input-field" placeholder="Confirm password">
                            </div>
                        </div>
                        <p class="text-xs text-content-tertiary">By submitting, you agree to our <a href="{{ route('recovery.page', 'terms-conditions') }}" class="text-primary hover:text-primary-dark">Terms &amp; Conditions</a> and <a href="{{ route('recovery.page', 'privacy-policy') }}" class="text-primary hover:text-primary-dark">Privacy Policy</a>.</p>
                        <button type="submit" class="btn-primary w-full">Submit Claim &amp; Create Account</button>
                    </div>
                    <p class="mt-4 text-center text-sm text-content-secondary">
                        Already have an account? <a href="{{ route('login') }}" class="font-medium text-primary hover:text-primary-dark transition-colors">Sign in first</a>
                    </p>
                </div>
            </template>
            <template x-if="!isGuest">
                <div>
                    <h3 class="text-xl font-semibold text-content mb-2">Review &amp; submit</h3>
                    <p class="text-sm text-content-secondary mb-6">Please confirm your case details below.</p>
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between py-2 border-b border-border-muted">
                            <span class="text-sm text-content-tertiary">Fraud type</span>
                            <span class="text-sm font-medium text-content" x-text="answers.issue"></span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-border-muted">
                            <span class="text-sm text-content-tertiary">Amount lost</span>
                            <span class="text-sm font-medium text-content" x-text="answers.amount"></span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-border-muted">
                            <span class="text-sm text-content-tertiary">Timeframe</span>
                            <span class="text-sm font-medium text-content" x-text="answers.timeframe"></span>
                        </div>
                        <div x-show="fileNames.length > 0" class="flex justify-between py-2 border-b border-border-muted">
                            <span class="text-sm text-content-tertiary">Documents</span>
                            <span class="text-sm font-medium text-content" x-text="fileNames.length + ' file(s)'"></span>
                        </div>
                    </div>
                    <button type="submit" class="btn-primary w-full">Submit Case</button>
                </div>
            </template>
        </div>

        {{-- Back button --}}
        <div x-show="step > 1" class="mt-6">
            <button type="button" @click="prevStep()" class="flex items-center gap-1 text-sm text-content-tertiary hover:text-content transition-colors">
                <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i> Back
            </button>
        </div>
    </form>
</div>

<script>
function claimWizard(isGuest) {
    return {
        step: 1,
        isGuest: isGuest,
        get totalSteps() { return this.isGuest ? 5 : 5; },
        get finalStep() { return 5; },
        answers: {
            issue: '', amount: '', timeframe: '', description: '',
            name: '', email: '', phone: '', country: '', password: '', password_confirmation: ''
        },
        fileNames: [],
        fraudTypes: [
            'Trading / Investment Scam', 'Cryptocurrency Fraud', 'Forex Trading Scam',
            'Romance Scam', 'Phishing / Impersonation', 'Bank Fraud',
            'NFT / Digital Asset Scam', 'Other'
        ],
        amountRanges: [
            'Under £5,000', '£5,000 - £25,000', '£25,000 - £100,000',
            '£100,000 - £500,000', '£500,000+', 'Prefer not to say'
        ],
        timeframes: [
            'Less than 3 months ago', '3 - 6 months ago', '6 - 12 months ago',
            '1 - 2 years ago', '2+ years ago', 'Ongoing'
        ],
        nextStep() {
            if (this.step < this.totalSteps) this.step++;
            this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
        },
        prevStep() {
            if (this.step > 1) this.step--;
            this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
        },
        handleFiles(event) {
            const dt = new DataTransfer();
            // Keep existing files
            if (this.$refs.fileInput.files) {
                for (let f of this.$refs.fileInput.files) dt.items.add(f);
            }
            // Add new
            for (let f of event.target.files) {
                if (f.size <= 10485760) dt.items.add(f);
            }
            this.$refs.fileInput.files = dt.files;
            this.fileNames = Array.from(dt.files).map(f => f.name);
        },
        removeFile(index) {
            const dt = new DataTransfer();
            const files = this.$refs.fileInput.files;
            for (let i = 0; i < files.length; i++) {
                if (i !== index) dt.items.add(files[i]);
            }
            this.$refs.fileInput.files = dt.files;
            this.fileNames.splice(index, 1);
        }
    };
}
</script>
