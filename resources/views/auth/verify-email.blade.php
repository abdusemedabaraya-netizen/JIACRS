<x-guest-layout>
<<<<<<< HEAD
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
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

                <h1>Verify Your Email</h1>

                <p>
                    Please verify your email address to continue.
                </p>

            </div>

            <div class="jiacrs-verification-message">
                {{ __('Thanks for signing up! Before getting started, please verify your email address by clicking the link we just emailed to you. If you did not receive the email, we can send you another.') }}
            </div>

            @if (session('status') == 'verification-link-sent')

                <div class="jiacrs-verification-success">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>

            @endif

            <div class="jiacrs-verification-actions">

                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <button type="submit" class="jiacrs-login-submit">
                        Resend Verification Email
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="jiacrs-logout-button">
                        Log Out
                    </button>
                </form>

            </div>

            <div class="jiacrs-back-home">
                <a href="{{ route('home') }}">
                    ← Back to JIACRS Home
                </a>
            </div>

        </div>

    </div>

</x-guest-layout>
>>>>>>> be38a6dd75183943501997739ad1d99c484cc4e9
