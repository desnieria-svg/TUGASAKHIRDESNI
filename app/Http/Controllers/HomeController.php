<?php
namespace App\Http\Controllers;
use App\Models\Barang;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    public function index()
    {
        // Tampilkan semua produk yang stoknya ada dulu, lalu habis
        $barang = Barang::orderByRaw("jumlah > 0 DESC")
                        ->orderBy('kategori')
                        ->orderBy('nama')
                        ->get();

        $kunjungan = session()->get('kunjungan', 0) + 1;
        if (!session()->has('pertama_kunjungan'))
            session()->put('pertama_kunjungan', now()->format('d/m/Y H:i:s'));
        session()->put('terakhir_kunjungan', now()->format('d/m/Y H:i:s'));
        session()->put('kunjungan', $kunjungan);

        $stats = null;
        $pesananTerbaru = null;
        $kategoriStats = null;

        if (auth()->check() && auth()->user()->role === 'admin') {
            $hasUserId = Schema::hasColumn('pesanans', 'user_id');

            $stats = [
                ['judul' => 'Total Produk', 'nilai' => Barang::count(), 'ikon' => '📦', 'warna' => 'blue'],
                ['judul' => 'Pesanan Masuk', 'nilai' => Pesanan::menunggu()->count(), 'ikon' => '⏳', 'warna' => 'orange'],
                ['judul' => 'Pelanggan Aktif', 'nilai' => $hasUserId
                    ? Pesanan::whereNotNull('user_id')->distinct('user_id')->count('user_id')
                    : Pesanan::distinct('nama_pelanggan')->count('nama_pelanggan'),
                 'ikon' => '👥', 'warna' => 'purple'],
                ['judul' => 'Total Pendapatan', 'nilai' => 'Rp ' . number_format(Pesanan::selesai()->sum('total_harga'), 0, ',', '.'), 'ikon' => '💰', 'warna' => 'green'],
            ];

            $pesananTerbaru = Pesanan::latest()->take(8)->get();

            $maxStok = max(1, $barang->max('jumlah') ?? 1);
            $kategoriStats = $barang->groupBy('kategori')->map(function ($items, $kategori) use ($maxStok) {
                $totalStok = $items->sum('jumlah');
                return [
                    'kategori' => $kategori,
                    'jumlah_produk' => $items->count(),
                    'total_stok' => $totalStok,
                    'persen' => $maxStok > 0 ? min(100, round(($totalStok / $maxStok) * 100)) : 0,
                ];
            })->values();
        }

        return view('pages.home', compact('barang', 'kunjungan', 'stats', 'pesananTerbaru', 'kategoriStats'));
    }
}
