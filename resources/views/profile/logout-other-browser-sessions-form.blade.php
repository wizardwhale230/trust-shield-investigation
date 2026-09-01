<x-jet-action-section>
    <x-slot name="title"></x-slot>
    <x-slot name="description"></x-slot>

    <x-slot name="content">
        <div class="flex items-start gap-3 mb-4">
            <div class="w-10 h-10 rounded-md bg-info-light flex items-center justify-center flex-shrink-0">
                <i data-lucide="monitor" class="w-5 h-5 text-info"></i>
            </div>
            <div>
                <h2 class="text-base font-semibold text-content">{{ __('Browser Sessions') }}</h2>
                <p class="text-sm text-content-secondary mt-0.5">{{ __('Manage and log out your active sessions on other browsers and devices.') }}</p>
            </div>
        </div>

        <p class="text-sm text-content-secondary mb-4">
            {{ __('If necessary, you may log out of all of your other browser sessions across all of your devices. Some of your recent sessions are listed below; however, this list may not be exhaustive. If you feel your account has been compromised, you should also update your password.') }}
        </p>

        @if (count($this->sessions) > 0)
            <div class="space-y-3 mb-5">
                @foreach ($this->sessions as $session)
                    <div class="flex items-center gap-3 p-3 rounded-md border border-border-muted">
                        <div class="flex-shrink-0 text-content-tertiary">
                            @if ($session->agent->isDesktop())
                                <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                    <path d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6">
                                    <path d="M0 0h24v24H0z" stroke="none"></path><rect x="7" y="4" width="10" height="16" rx="1"></rect><path d="M11 5h2M12 17v.01"></path>
                                </svg>
                            @endif
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm font-medium text-content">{{ $session->agent->platform() }} - {{ $session->agent->browser() }}</p>
                            <p class="text-xs text-content-tertiary mt-0.5">
                                {{ $session->ip_address }}
                                @if ($session->is_current_device)
                                    &mdash; <span class="text-success font-medium">{{ __('This device') }}</span>
                                @else
                                    &mdash; {{ __('Last active') }} {{ $session->last_active }}
                                @endif
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="flex items-center gap-3">
            <x-jet-button wire:click="confirmLogout" wire:loading.attr="disabled">
                {{ __('Log Out Other Browser Sessions') }}
            </x-jet-button>

            <x-jet-action-message class="text-sm text-success" on="loggedOut">
                {{ __('Done.') }}
            </x-jet-action-message>
        </div>

        <!-- Log Out Other Devices Confirmation Modal -->
        <x-jet-dialog-modal wire:model="confirmingLogout">
            <x-slot name="title">
                <h3 class="text-base font-semibold text-content">{{ __('Log Out Other Browser Sessions') }}</h3>
            </x-slot>

            <x-slot name="content">
                <p class="text-sm text-content-secondary">{{ __('Please enter your password to confirm you would like to log out of your other browser sessions across all of your devices.') }}</p>

                <div class="mt-4" x-data="{}" x-on:confirming-logout-other-browser-sessions.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-jet-input type="password" class="input-field"
                                placeholder="{{ __('Password') }}"
                                x-ref="password"
                                wire:model.defer="password"
                                wire:keydown.enter="logoutOtherBrowserSessions" />

                    <x-jet-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('confirmingLogout')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-button class="ml-2" wire:click="logoutOtherBrowserSessions" wire:loading.attr="disabled">
                    {{ __('Log Out') }}
                </x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>
    </x-slot>
</x-jet-action-section>
