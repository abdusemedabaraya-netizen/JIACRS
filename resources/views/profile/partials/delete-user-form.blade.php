<<<<<<< HEAD
<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Delete Account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
=======
<section>

    <div class="jiacrs-profile-section-header">

        <h2 class="jiacrs-danger-title">
            Delete Account
        </h2>

        <p>
            Once your account is deleted, all of its resources and data
            will be permanently deleted. Before deleting your account,
            please download any data or information that you wish to retain.
        </p>

    </div>

    <button
        type="button"
        class="jiacrs-delete-btn"
        data-bs-toggle="modal"
        data-bs-target="#confirm-user-deletion">
        Delete Account
    </button>

    <div class="modal fade"
         id="confirm-user-deletion"
         tabindex="-1"
         aria-labelledby="confirmUserDeletionLabel"
         aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <form method="post"
                      action="{{ route('profile.destroy') }}">

                    @csrf
                    @method('delete')

                    <div class="modal-header">

                        <h5 class="modal-title"
                            id="confirmUserDeletionLabel">
                            Confirm Account Deletion
                        </h5>

                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close">
                        </button>

                    </div>

                    <div class="modal-body">

                        <p class="jiacrs-modal-description">
                            Are you sure you want to delete your account?
                        </p>

                        <p class="jiacrs-modal-description">
                            This action cannot be undone. Please enter
                            your password to confirm.
                        </p>

                        <label
                            for="delete_password"
                            class="jiacrs-profile-label">
                            Password
                        </label>

                        <input
                            id="delete_password"
                            name="password"
                            type="password"
                            class="jiacrs-profile-input"
                            placeholder="Enter your password"
                            required
                        >

                        <x-input-error
                            class="jiacrs-profile-error"
                            :messages="$errors->userDeletion->get('password')"
                        />

                    </div>

                    <div class="modal-footer">

                        <button type="button"
                                class="jiacrs-cancel-btn"
                                data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button type="submit"
                                class="jiacrs-delete-confirm-btn">
                            Delete Account
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</section>
>>>>>>> be38a6dd75183943501997739ad1d99c484cc4e9
