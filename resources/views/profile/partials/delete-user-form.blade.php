<section>
    <header>
        <h2>{{ __('Hapus Akun') }}</h2>
        <p>{{ __('Setelah akun dihapus, semua data dan riwayat pesanan akan hilang secara permanen. Pastikan Anda sudah menyimpan informasi yang diperlukan sebelum melanjutkan.') }}</p>
    </header>

    <button type="button" class="auth-btn-primary" style="background:linear-gradient(135deg,#ef4444,#dc2626); box-shadow:0 6px 18px rgba(220,38,38,0.3);" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
        {{ __('Hapus Akun') }}
    </button>

    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius:16px; border:none;">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-body" style="padding:28px;">
                        <h2 style="font-size:1.1rem; font-weight:800; color:#0f172a; margin:0 0 8px;">
                            {{ __('Yakin ingin menghapus akun Anda?') }}
                        </h2>

                        <p style="font-size:0.85rem; color:#64748b; margin:0 0 16px;">
                            {{ __('Tindakan ini permanen. Masukkan password Anda untuk mengonfirmasi.') }}
                        </p>

                        <x-input-label for="password_delete" value="{{ __('Password') }}" class="sr-only" />
                        <x-text-input
                            id="password_delete"
                            name="password"
                            type="password"
                            class="mt-1"
                            placeholder="{{ __('Password') }}"
                        />
                        <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                    </div>

                    <div class="modal-footer" style="border:none; padding:0 28px 28px; gap:10px;">
                        <button type="button" class="auth-btn-primary" style="background:#f1f5f9; color:#475569; box-shadow:none;" data-bs-dismiss="modal">
                            {{ __('Batal') }}
                        </button>
                        <button type="submit" class="auth-btn-primary" style="background:linear-gradient(135deg,#ef4444,#dc2626); box-shadow:0 6px 18px rgba(220,38,38,0.3);">
                            {{ __('Hapus Akun') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
