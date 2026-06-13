<section>
    <header>
        <h2>{{ __('Informasi Profil') }}</h2>
        <p>{{ __('Perbarui nama dan alamat email akun Anda.') }}</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4" style="display:flex; flex-direction:column; gap:18px;">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nama')" />
            <x-text-input id="name" name="name" type="text" class="mt-1" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="mt-2" style="font-size:0.85rem;">
                        {{ __('Alamat email Anda belum terverifikasi.') }}

                        <button form="send-verification" style="background:none;border:none;padding:0;text-decoration:underline;color:#0284c7;font-size:0.85rem;cursor:pointer;">
                            {{ __('Klik di sini untuk kirim ulang email verifikasi.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-green-600" style="font-size:0.85rem; font-weight:600;">
                            {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div style="display:flex; align-items:center; gap:16px;">
            <x-primary-button>{{ __('Simpan') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p class="text-green-600" style="font-size:0.85rem; font-weight:600; margin:0;">{{ __('Tersimpan.') }}</p>
            @endif
        </div>
    </form>
</section>
