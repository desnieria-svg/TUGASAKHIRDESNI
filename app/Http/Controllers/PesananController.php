<?php
namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class PesananController extends Controller
{
    private function hasColumn(string $col): bool
    {
        return Schema::hasColumn('pesanans', $col);
    }

    public function checkout(Request $request)
    {
        return view('pesanan.checkout');
    }

    public function store(Request $request)
    {
        $manualMethods = ['qris','transfer_bca','transfer_bri','transfer_bni','transfer_mandiri','cod'];

        $rules = [
            'nama_pelanggan'   => 'required|string|max:100',
            'no_hp'            => 'required|string|max:20',
            'metode_bayar'     => 'required|in:' . implode(',', $manualMethods),
            'jenis_pengiriman' => 'required|in:jemput,antar',
            'catatan'          => 'nullable|string',
            'items'            => 'required|string',
        ];

        if ($request->jenis_pengiriman === 'antar') {
            $rules['kecamatan'] = 'required|string';
            $rules['kelurahan'] = 'required|string';
            $rules['rt_rw']     = 'required|string|max:20';
            $rules['alamat']    = 'required|string';
        }

        if ($request->metode_bayar !== 'cod') {
            $rules['bukti_bayar'] = 'required|file|mimes:jpg,jpeg,png,pdf|max:5120';
        }

        $request->validate($rules);

        $items      = json_decode($request->items, true);

        // Validasi stok server-side (jaga-jaga jika validasi di sisi klien dilewati)
        foreach ($items as $item) {
            if (!isset($item['id'])) continue;
            $barang = Barang::find($item['id']);
            $qty    = max(1, (int)($item['qty'] ?? 1));
            if (!$barang || $barang->jumlah < $qty) {
                return back()
                    ->withInput()
                    ->withErrors(['items' => 'Stok untuk "' . ($item['nama'] ?? 'produk') . '" tidak cukup. Sisa stok: ' . ($barang->jumlah ?? 0) . '.']);
            }
        }

        $totalHarga = array_sum(array_map(fn($i) => ($i['harga'] ?? 0) * ($i['qty'] ?? 1), $items));
        $namaProduk = implode(', ', array_column($items, 'nama'));

        $alamatFull = $request->jenis_pengiriman === 'antar'
            ? "Kec. {$request->kecamatan}, Kel. {$request->kelurahan}, RT/RW {$request->rt_rw} — {$request->alamat}"
            : 'Jemput sendiri';

        // Handle bukti bayar upload
        $buktiBayarPath = null;
        if ($request->hasFile('bukti_bayar') && $request->file('bukti_bayar')->isValid()) {
            $buktiBayarPath = $request->file('bukti_bayar')->store('bukti_bayar', 'public');
        }

        $data = [
            'nama_pelanggan'   => $request->nama_pelanggan,
            'alamat'           => $alamatFull,
            'no_hp'            => $request->no_hp,
            'nama_produk'      => $namaProduk,
            'kategori'         => $items[0]['kategori'] ?? 'galon',
            'jumlah'           => array_sum(array_column($items, 'qty')),
            'harga_satuan'     => $items[0]['harga'] ?? 0,
            'total_harga'      => $totalHarga,
            'status'           => 'menunggu',
            'tanggal_pesan'    => now()->toDateString(),
        ];

        if ($this->hasColumn('user_id'))           $data['user_id']          = auth()->id();
        if ($this->hasColumn('metode_bayar'))       $data['metode_bayar']     = $request->metode_bayar;
        if ($this->hasColumn('catatan'))            $data['catatan']          = $request->catatan;
        if ($this->hasColumn('kode_pesanan'))       $data['kode_pesanan']     = Pesanan::generateKode();
        if ($this->hasColumn('jenis_pengiriman'))   $data['jenis_pengiriman'] = $request->jenis_pengiriman;
        if ($this->hasColumn('kecamatan'))          $data['kecamatan']        = $request->kecamatan ?? null;
        if ($this->hasColumn('kelurahan'))          $data['kelurahan']        = $request->kelurahan ?? null;
        if ($this->hasColumn('rt_rw'))              $data['rt_rw']            = $request->rt_rw ?? null;
        if ($this->hasColumn('bukti_bayar'))        $data['bukti_bayar']      = $buktiBayarPath;
        if ($this->hasColumn('konfirmasi_bayar'))   $data['konfirmasi_bayar'] = ($request->metode_bayar === 'cod') ? 'dikonfirmasi' : 'menunggu';

        $pesanan = Pesanan::create($data);

        foreach ($items as $item) {
            $barang = isset($item['id']) ? Barang::find($item['id']) : null;
            if ($barang) {
                $barang->decrement('jumlah', max(1, (int)($item['qty'] ?? 1)));
                try { $pesanan->barangs()->attach($barang->id, ['jumlah' => $item['qty'] ?? 1]); } catch (\Exception $e) {}
            }
        }

        session()->forget('cart');

        return redirect()->route('pesanan.sukses', $pesanan->id);
    }

    public function sukses(Pesanan $pesanan)
    {
        return view('pesanan.sukses', compact('pesanan'));
    }

    public function riwayat()
    {
        $query = $this->hasColumn('user_id')
            ? Pesanan::where('user_id', auth()->id())
            : Pesanan::where('nama_pelanggan', auth()->user()->name);

        $pesanans = $query->latest()->paginate(10);
        return view('pesanan.riwayat', compact('pesanans'));
    }

    public function show(Pesanan $pesanan)
    {
        $isOwner = $this->hasColumn('user_id')
            ? $pesanan->user_id === auth()->id()
            : $pesanan->nama_pelanggan === auth()->user()->name;

        abort_unless($isOwner || auth()->user()->role === 'admin', 403);
        return view('pesanan.show', compact('pesanan'));
    }

    public function buktiBayar(Pesanan $pesanan)
    {
        $isOwner = $this->hasColumn('user_id')
            ? $pesanan->user_id === auth()->id()
            : $pesanan->nama_pelanggan === auth()->user()->name;

        abort_unless($isOwner || auth()->user()->role === 'admin', 403);

        if (!$pesanan->bukti_bayar || !Storage::disk('public')->exists($pesanan->bukti_bayar)) {
            abort(404, 'Bukti pembayaran tidak ditemukan.');
        }

        $path = Storage::disk('public')->path($pesanan->bukti_bayar);
        return response()->file($path);
    }

    public function adminIndex(Request $request)
    {
        $query = Pesanan::query();

        if ($request->filled('dari'))   $query->whereDate('tanggal_pesan', '>=', $request->dari);
        if ($request->filled('sampai')) $query->whereDate('tanggal_pesan', '<=', $request->sampai);

        $pesanans = $query->latest()->paginate(20)->appends($request->query());

        $start = now()->subDays(13)->startOfDay();
        $rows  = Pesanan::selesai()
            ->where('tanggal_pesan', '>=', $start->toDateString())
            ->selectRaw('tanggal_pesan, SUM(total_harga) as total, COUNT(*) as jumlah')
            ->groupBy('tanggal_pesan')
            ->get()
            ->keyBy('tanggal_pesan');

        $chartLabels = [];
        $chartTotals = [];
        for ($i = 13; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $chartLabels[] = \Carbon\Carbon::parse($date)->format('d/m');
            $chartTotals[] = (int) ($rows[$date]->total ?? 0);
        }

        return view('pesanan.admin', compact('pesanans', 'chartLabels', 'chartTotals'));
    }

    public function updateStatus(Request $request, Pesanan $pesanan)
    {
        if (in_array($pesanan->status, ['selesai', 'batal'])) {
            return back()->with('error', 'Pesanan ini sudah ' . $pesanan->status . ' dan tidak dapat diubah lagi.');
        }
        $request->validate(['status' => 'required|in:menunggu,proses,selesai,batal']);
        $pesanan->update(['status' => $request->status]);
        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function konfirmasiBayar(Request $request, Pesanan $pesanan)
    {
        $request->validate(['konfirmasi_bayar' => 'required|in:dikonfirmasi,ditolak']);
        if ($this->hasColumn('konfirmasi_bayar')) {
            $pesanan->update(['konfirmasi_bayar' => $request->konfirmasi_bayar]);
        }
        $msg = $request->konfirmasi_bayar === 'dikonfirmasi' ? 'Pembayaran dikonfirmasi!' : 'Pembayaran ditolak.';
        return back()->with('success', $msg);
    }
}
