<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pesanan;

class PesananSeeder extends Seeder
{
    public function run(): void
    {
        $pesanans = [
            [
                'nama_pelanggan' => 'Budi Santoso',
                'alamat'         => 'Jl. Merdeka No. 12, Bandung',
                'no_hp'          => '081234567890',
                'nama_produk'    => 'Galon Isi Ulang 19L',
                'kategori'       => 'galon',
                'jumlah'         => 3,
                'harga_satuan'   => 20000,
                'total_harga'    => 60000,
                'status'         => 'selesai',
                'tanggal_pesan'  => '2025-01-10',
            ],
            [
                'nama_pelanggan' => 'Siti Rahayu',
                'alamat'         => 'Jl. Sudirman No. 45, Bandung',
                'no_hp'          => '082345678901',
                'nama_produk'    => 'Botol 1500ml Premium',
                'kategori'       => 'botol',
                'jumlah'         => 10,
                'harga_satuan'   => 8000,
                'total_harga'    => 80000,
                'status'         => 'proses',
                'tanggal_pesan'  => '2025-01-12',
            ],
            [
                'nama_pelanggan' => 'Ahmad Fauzi',
                'alamat'         => 'Jl. Diponegoro No. 7, Cimahi',
                'no_hp'          => '083456789012',
                'nama_produk'    => 'Jerigen Air 10L',
                'kategori'       => 'jerigen',
                'jumlah'         => 2,
                'harga_satuan'   => 45000,
                'total_harga'    => 90000,
                'status'         => 'menunggu',
                'tanggal_pesan'  => '2025-01-14',
            ],
            [
                'nama_pelanggan' => 'Dewi Lestari',
                'alamat'         => 'Jl. Asia Afrika No. 3, Bandung',
                'no_hp'          => '084567890123',
                'nama_produk'    => 'Cup Air 240ml (1 Dus)',
                'kategori'       => 'cup',
                'jumlah'         => 5,
                'harga_satuan'   => 25000,
                'total_harga'    => 125000,
                'status'         => 'selesai',
                'tanggal_pesan'  => '2025-01-15',
            ],
            [
                'nama_pelanggan' => 'Rudi Hermawan',
                'alamat'         => 'Jl. Gatot Subroto No. 22, Bandung',
                'no_hp'          => '085678901234',
                'nama_produk'    => 'Galon Premium Alkaline',
                'kategori'       => 'galon',
                'jumlah'         => 4,
                'harga_satuan'   => 35000,
                'total_harga'    => 140000,
                'status'         => 'proses',
                'tanggal_pesan'  => '2025-01-17',
            ],
            [
                'nama_pelanggan' => 'Nina Agustina',
                'alamat'         => 'Jl. Pasteur No. 88, Bandung',
                'no_hp'          => '086789012345',
                'nama_produk'    => 'Jerigen Ekstra 20L',
                'kategori'       => 'jerigen',
                'jumlah'         => 1,
                'harga_satuan'   => 80000,
                'total_harga'    => 80000,
                'status'         => 'menunggu',
                'tanggal_pesan'  => '2025-01-19',
            ],
            [
                'nama_pelanggan' => 'Eko Prasetyo',
                'alamat'         => 'Jl. Cihampelas No. 15, Bandung',
                'no_hp'          => '087890123456',
                'nama_produk'    => 'Cup Mineral 330ml (24 pcs)',
                'kategori'       => 'cup',
                'jumlah'         => 8,
                'harga_satuan'   => 18000,
                'total_harga'    => 144000,
                'status'         => 'batal',
                'tanggal_pesan'  => '2025-01-20',
            ],
        ];

        foreach ($pesanans as $data) {
            Pesanan::create($data);
        }
    }
}
