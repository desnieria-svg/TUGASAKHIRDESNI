<x-guest-layout>
    <div style="text-align:center; margin-bottom:24px;">
        <h1 style="font-size:1.5rem; font-weight:800; color:#f1f5f9; margin-bottom:6px;">Masuk ke <span style="color:#38bdf8;">BioAqua Lab</span></h1>
        <p style="font-size:0.85rem; color:#94a3b8; margin:0;">Masukkan email dan password Anda</p>
    </div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <div class="auth-input-group">
                <span class="auth-input-icon">✉️</span>
                <x-text-input id="email" class="block mt-1 w-full auth-input-has-icon" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <div class="auth-input-group">
                <span class="auth-input-icon">🔒</span>
                <x-text-input id="password" class="block mt-1 w-full auth-input-has-icon"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="auth-checkbox" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="text-center mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm" style="color:#38bdf8;" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <x-primary-button class="w-full mt-4 justify-center">
            {{ __('Log in') }} <span aria-hidden="true">→</span>
        </x-primary-button>
    </form>

    <div class="auth-divider"><span>Belum punya akun?</span></div>
    <p style="text-align:center; margin-top:10px; font-size:0.9rem;">
        <a href="{{ route('register') }}" style="color:#38bdf8; font-weight:700; text-decoration:none;">Daftar di sini <span aria-hidden="true">→</span></a>
    </p>
</x-guest-layout>