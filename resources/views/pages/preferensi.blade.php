@extends('layouts.app')

@section('title', 'Preferensi')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">⚙️ Pengaturan Preferensi</h5>
                </div>
                <div class="card-body">

                    {{-- Pilihan Tema --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tema Tampilan</label>
                        <select id="pilih-tema" class="form-select">
                            <option value="light">☀️ Light</option>
                            <option value="dark">🌙 Dark</option>
                            <option value="system">💻 Ikuti System</option>
                        </select>
                    </div>

                    {{-- Pilihan Ukuran Font --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Ukuran Font</label>
                        <select id="pilih-font" class="form-select">
                            <option value="small">Kecil</option>
                            <option value="medium">Sedang</option>
                            <option value="large">Besar</option>
                        </select>
                    </div>

                    <button onclick="simpanPreferensi()" class="btn btn-primary w-100">
                        💾 Simpan Preferensi
                    </button>

                    <div id="pesan-simpan" class="alert alert-success mt-3" style="display:none;">
                        ✅ Preferensi berhasil disimpan!
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Set pilihan sesuai cookie saat ini
    window.addEventListener('DOMContentLoaded', function () {
        const temaSaatIni = getCookie('tema') || 'light';
        const fontSaatIni = getCookie('font_size') || 'medium';
        document.getElementById('pilih-tema').value = temaSaatIni;
        document.getElementById('pilih-font').value = fontSaatIni;
    });

    async function simpanPreferensi() {
        const tema     = document.getElementById('pilih-tema').value;
        const fontSize = document.getElementById('pilih-font').value;

        const response = await fetch('{{ route("preferensi.simpan") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ tema: tema, font_size: fontSize })
        });

        const data = await response.json();

        if (data.success) {
            // Terapkan langsung tanpa reload
            setCookie('tema', tema, 30);
            setCookie('font_size', fontSize, 30);

            if (tema === 'dark') {
                document.documentElement.classList.add('dark-mode');
            } else {
                document.documentElement.classList.remove('dark-mode');
            }

            document.getElementById('pesan-simpan').style.display = 'block';
            setTimeout(() => {
                document.getElementById('pesan-simpan').style.display = 'none';
            }, 3000);
        }
    }
</script>
@endpush