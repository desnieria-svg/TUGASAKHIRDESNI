<section>
    <header>
        <h2>{{ __('Ubah Password') }}</h2>
        <p>{{ __('Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.') }}</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-4" style="display:flex; flex-direction:column; gap:18px;">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Password Saat Ini')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('Password Baru')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Konfirmasi Password')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div style="display:flex; align-items:center; gap:16px;">
            <x-primary-button>{{ __('Simpan') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p class="text-green-600" style="font-size:0.85rem; font-weight:600; margin:0;">{{ __('Tersimpan.') }}</p>
            @endif
        </div>
    </form>
</section>
