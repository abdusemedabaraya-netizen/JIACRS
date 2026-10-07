<section>
<<<<<<< HEAD
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
=======

    <div class="jiacrs-profile-section-header">

        <h2>Update Password</h2>

        <p>
            Ensure your account is using a long, random password to stay secure.
        </p>

    </div>

    <form method="post"
          action="{{ route('password.update') }}"
          class="jiacrs-profile-form">

        @csrf
        @method('put')

        <div class="jiacrs-profile-form-group">

            <label
                for="update_password_current_password"
                class="jiacrs-profile-label">
                Current Password
            </label>

            <input
                id="update_password_current_password"
                name="current_password"
                type="password"
                class="jiacrs-profile-input"
                autocomplete="current-password"
            >

            <x-input-error
                class="jiacrs-profile-error"
                :messages="$errors->updatePassword->get('current_password')"
            />

        </div>

        <div class="jiacrs-profile-form-group">

            <label
                for="update_password_password"
                class="jiacrs-profile-label">
                New Password
            </label>

            <input
                id="update_password_password"
                name="password"
                type="password"
                class="jiacrs-profile-input"
                autocomplete="new-password"
            >

            <x-input-error
                class="jiacrs-profile-error"
                :messages="$errors->updatePassword->get('password')"
            />

        </div>

        <div class="jiacrs-profile-form-group">

            <label
                for="update_password_password_confirmation"
                class="jiacrs-profile-label">
                Confirm Password
            </label>

            <input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                class="jiacrs-profile-input"
                autocomplete="new-password"
            >

            <x-input-error
                class="jiacrs-profile-error"
                :messages="$errors->updatePassword->get('password_confirmation')"
            />

        </div>

        <div class="jiacrs-profile-form-actions">

            <button type="submit"
                    class="jiacrs-profile-save-btn">
                Save
            </button>

            @if (session('status') === 'password-updated')
                <span class="jiacrs-profile-saved">
                    Saved.
                </span>
            @endif

        </div>

    </form>

</section>
>>>>>>> be38a6dd75183943501997739ad1d99c484cc4e9
