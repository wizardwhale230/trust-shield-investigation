<x-jet-action-section>
    <x-slot name="content">
        <div class="flex items-start gap-3 mb-4">
            <div class="w-10 h-10 rounded-md bg-primary-light flex items-center justify-center flex-shrink-0">
                <i data-lucide="shield-check" class="w-5 h-5 text-primary"></i>
            </div>
            <div>
                <h2 class="text-base font-semibold text-content">{{ __('Two Factor Authentication') }}</h2>
                <p class="text-sm text-content-secondary mt-0.5">
                    @if ($this->enabled)
                        {{ __('You have enabled two factor authentication.') }}
                    @else
                        {{ __('You have not enabled two factor authentication.') }}
                    @endif
                </p>
            </div>
        </div>

        <p class="text-sm text-content-secondary mb-4">
            {{ __('When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s Google Authenticator application.') }}
        </p>

        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="mb-4">
                    <p class="text-sm text-content-secondary mb-3">
                        {{ __('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application.') }}
                    </p>
                    <div class="inline-block p-3 bg-white rounded-lg border border-border-muted">
                        {!! $this->user->twoFactorQrCodeSvg() !!}
                    </div>
                </div>
            @endif

            @if ($showingRecoveryCodes)
                <div class="mb-4">
                    <p class="text-sm font-medium text-content mb-3">
                        {{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.') }}
                    </p>
                    <div class="bg-surface-muted rounded-md p-4 font-mono text-sm space-y-1">
                        @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                            <div class="text-content">{{ $code }}</div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endif

        <div class="flex flex-wrap gap-3 mt-5">
            @if (! $this->enabled)
                <x-jet-confirms-password wire:then="enableTwoFactorAuthentication">
                    <button type="button" class="btn-primary" wire:loading.attr="disabled">
                        {{ __('Enable') }}
                    </button>
                </x-jet-confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-jet-confirms-password wire:then="regenerateRecoveryCodes">
                        <button type="button" class="btn-secondary" wire:loading.attr="disabled">
                            {{ __('Regenerate Recovery Codes') }}
                        </button>
                    </x-jet-confirms-password>
                @else
                    <x-jet-confirms-password wire:then="showRecoveryCodes">
                        <button type="button" class="btn-secondary" wire:loading.attr="disabled">
                            {{ __('Show Recovery Codes') }}
                        </button>
                    </x-jet-confirms-password>
                @endif

                <x-jet-confirms-password wire:then="disableTwoFactorAuthentication">
                    <button type="button" class="btn-danger" wire:loading.attr="disabled">
                        {{ __('Disable') }}
                    </button>
                </x-jet-confirms-password>
            @endif
        </div>
    </x-slot>
</x-jet-action-section>