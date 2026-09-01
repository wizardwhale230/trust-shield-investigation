<div
    x-data="{
        step: 'enter',
        amount: @entangle('amount'),
        attested: false,
        error: '',
        validateAndReview() {
            this.error = '';
            const amt = parseFloat(this.amount);
            if (!amt || amt <= 0) { this.error = 'Enter the amount you wish to disburse.'; return; }
            this.step = 'review';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    }"
    x-cloak
>
    @if (Session::has('status'))
        <div class="flex items-start gap-3 bg-info-light border border-info/20 text-info rounded-md px-4 py-3 text-sm mb-4">
            <i data-lucide="info" class="w-4 h-4 flex-shrink-0 mt-0.5"></i>
            <div class="flex-1">{{ Session::get('status') }}</div>
        </div>
    @endif
    @if (Session::has('error'))
        <div class="flex items-start gap-3 bg-danger-light border border-danger/20 text-danger rounded-md px-4 py-3 text-sm mb-4">
            <i data-lucide="alert-circle" class="w-4 h-4 flex-shrink-0 mt-0.5"></i>
            <div class="flex-1">{{ Session::get('error') }}</div>
        </div>
    @endif

    {{-- Compliance notice (no third-party brand references) --}}
    <div class="flex items-start gap-3 bg-warning-light border border-warning/20 text-warning rounded-md px-4 py-3 text-sm mb-5">
        <i data-lucide="shield-alert" class="w-4 h-4 flex-shrink-0 mt-0.5"></i>
        <div class="text-xs leading-relaxed">
            <p class="font-medium mb-0.5">Automated settlement gateway</p>
            <p class="opacity-90">
                Disbursements via this channel are released through an automated settlement gateway to the verified destination on file. Please confirm the destination matches your records before authorising &mdash; the firm cannot recall an instruction once funds leave client escrow on this channel.
            </p>
        </div>
    </div>

    {{-- ============ Step 1: Entry pane ============ --}}
    <form wire:submit.prevent='withdraw'>
        <div x-show="step === 'enter'">
            <div class="mb-5">
                <h3 class="text-base font-semibold text-content">Enter disbursement details</h3>
                <p class="text-xs text-content-secondary mt-0.5">{{ $payment_mode }} disbursement via the firm's automated settlement channel.</p>
            </div>

            <div class="mb-4">
                <label class="form-label">Amount to disburse ({{ $settings->currency }})</label>
                <input class="input-field" placeholder="0.00" type="number" step="any" min="0"
                       wire:model.defer='amount' name="amount" required>
            </div>

            <input value="{{ $payment_mode }}" type="hidden" name="method">

            <div x-show="error" x-cloak class="mb-4 flex items-start gap-2 bg-danger-light border border-danger/20 text-danger rounded-md px-3 py-2 text-xs">
                <i data-lucide="alert-circle" class="w-3.5 h-3.5 flex-shrink-0 mt-0.5"></i>
                <span x-text="error"></span>
            </div>

            <div class="flex flex-col sm:flex-row gap-2 sm:justify-end pt-2 border-t border-border-muted">
                <a href="{{ route('withdrawalsdeposits') }}" class="btn-ghost text-sm">Cancel</a>
                <button type="button" @click="validateAndReview()" class="btn-primary">
                    Continue to review
                    <i data-lucide="arrow-right" class="w-4 h-4 ml-1.5"></i>
                </button>
            </div>
        </div>

        {{-- ============ Step 2: Review pane ============ --}}
        <div x-show="step === 'review'" x-cloak>
            <div class="mb-5">
                <h3 class="text-base font-semibold text-content">Review &amp; authorise this instruction</h3>
                <p class="text-xs text-content-secondary mt-0.5">Confirm the disbursement details below, then authorise the automated release.</p>
            </div>

            <div class="rounded-md border border-border-muted divide-y divide-border-muted text-sm">
                <div class="flex justify-between px-4 py-3">
                    <dt class="text-content-secondary">Channel</dt>
                    <dd class="text-content font-medium">{{ $payment_mode }}</dd>
                </div>
                <div class="flex justify-between px-4 py-3">
                    <dt class="text-content-secondary">Channel type</dt>
                    <dd class="text-content font-medium">Automated settlement gateway</dd>
                </div>
                <div class="flex justify-between px-4 py-3">
                    <dt class="text-content-secondary">Amount requested</dt>
                    <dd class="text-content font-semibold">{{ $settings->currency }}<span x-text="(parseFloat(amount) || 0).toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})"></span></dd>
                </div>
                <div class="flex justify-between px-4 py-3">
                    <dt class="text-content-secondary">Beneficiary</dt>
                    <dd class="text-content font-medium">Verified {{ $payment_mode }} destination on file</dd>
                </div>
            </div>

            <div class="mt-5 flex items-start gap-3 bg-surface-subtle border border-border-muted rounded-md px-4 py-3">
                <input id="attest_auto" type="checkbox" x-model="attested"
                       class="mt-0.5 h-4 w-4 rounded border-border text-primary focus:ring-primary">
                <label for="attest_auto" class="text-xs text-content-secondary leading-relaxed">
                    I confirm I am the verified client of record and authorise the firm to release the amount above through the automated settlement gateway to the verified destination on file. I acknowledge that automated releases cannot be recalled once submitted.
                </label>
            </div>

            <div class="flex flex-col sm:flex-row gap-2 sm:justify-end mt-5 pt-4 border-t border-border-muted">
                <button type="button" @click="step = 'enter'" class="btn-secondary">
                    <i data-lucide="arrow-left" class="w-4 h-4 mr-1.5"></i>
                    Back to edit
                </button>
                <button class="btn-primary" wire:loading.attr='disabled' wire:target='withdraw' type='submit'
                        :disabled="!attested" :class="!attested && 'opacity-60 cursor-not-allowed'">
                    <span wire:loading.remove wire:target='withdraw'>Authorise automated disbursement</span>
                    <span wire:loading wire:target='withdraw'>Submitting&hellip;</span>
                </button>
            </div>
        </div>
    </form>
</div>
