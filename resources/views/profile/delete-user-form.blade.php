
<x-jet-action-section>
    <x-slot name="content">
        <div class="flex items-start gap-3 mb-4">
            <div class="w-10 h-10 rounded-md bg-danger-light flex items-center justify-center flex-shrink-0">
                <i data-lucide="trash-2" class="w-5 h-5 text-danger"></i>
            </div>
            <div>
                <h2 class="text-base font-semibold text-content">{{ __('Delete Account') }}</h2>
                <p class="text-sm text-content-secondary mt-0.5">{{ __('Permanently delete your account.') }}</p>
            </div>
        </div>

        <p class="text-sm text-content-secondary mb-5">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>

        <div>
            <x-jet-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                {{ __('Delete Account') }}
            </x-jet-danger-button>
        </div>

        <!-- Delete User Confirmation Modal -->
        <x-jet-dialog-modal wire:model="confirmingUserDeletion">
            <x-slot name="title">
                <h3 class="text-base font-semibold text-content">{{ __('Delete Account') }}</h3>
            </x-slot>

            <x-slot name="content">
                <p class="text-sm text-content-secondary">{{ __('Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}</p>

                <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-jet-input type="password" class="input-field"
                                placeholder="{{ __('Password') }}"
                                x-ref="password"
                                wire:model.defer="password"
                                wire:keydown.enter="deleteUser" />

                    <x-jet-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="deleteUser" wire:loading.attr="disabled">
                    {{ __('Delete Account') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>
    </x-slot>
</x-jet-action-section>
