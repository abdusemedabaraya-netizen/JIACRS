<x-guest-layout>
<<<<<<< HEAD
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
=======

    <div class="jiacrs-auth-page">

        <div class="jiacrs-auth-card">

            <div class="jiacrs-auth-header">

                <a href="{{ route('home') }}" class="jiacrs-auth-brand">

                    <img src="{{ asset('images/jimma-logo.png') }}"
                         alt="Jimma University Logo"
                         class="jiacrs-auth-logo">

                    <div>
                        <div class="jiacrs-auth-university">
                            JIMMA UNIVERSITY
                        </div>

                        <div class="jiacrs-auth-system">
                            Integrity and Anti-Corruption Reporting System
                        </div>
                    </div>

                </a>

                <h1>Forgot Password?</h1>

                <p>
                    Enter your email address to receive a password reset link.
                </p>

            </div>

            <x-auth-session-status
                class="jiacrs-auth-status"
                :status="session('status')"
            />

            <form method="POST"
                  action="{{ route('password.email') }}"
                  class="jiacrs-auth-form">

                @csrf

                <div class="jiacrs-form-group">

                    <label for="email" class="jiacrs-form-label">
                        Email Address
                    </label>

                    <input
                        id="email"
                        class="jiacrs-form-input"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="email"
                        placeholder="Enter your email address"
                    >

                    <x-input-error
                        :messages="$errors->get('email')"
                        class="jiacrs-form-error"
                    />

                </div>

                <button type="submit" class="jiacrs-login-submit">
                    Email Password Reset Link
                </button>

                <div class="jiacrs-auth-register">
                    <span>Remember your password?</span>

                    <a href="{{ route('login') }}">
                        Log in
                    </a>
                </div>

            </form>

            <div class="jiacrs-back-home">
                <a href="{{ route('home') }}">
                    ← Back to JIACRS Home
                </a>
            </div>

        </div>

    </div>

</x-guest-layout>
>>>>>>> be38a6dd75183943501997739ad1d99c484cc4e9
