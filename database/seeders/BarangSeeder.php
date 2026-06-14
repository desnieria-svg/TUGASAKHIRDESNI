<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Barang;
use App\Models\User;
class BarangSeeder extends Seeder {
    public function run(): void {
        $adminId = User::where('role','admin')->first()?->id ?? 1;
        Barang::truncate();
        $products = [
            ['nama' => 'AQUA Botol 600ml',     'file' => 'AQUA BOTOL.jpeg',     'kategori' => 'botol', 'harga' => 5000,  'supplier' => 'PT Tirta Investama',   'kode' => 'BA-001', 'satuan' => 'botol', 'jumlah' => 100],
            ['nama' => 'VIT Botol 600ml',       'file' => 'VIT BOTOL.jpeg',      'kategori' => 'botol', 'harga' => 4000,  'supplier' => 'PT Tirta Fresindo',    'kode' => 'BA-002', 'satuan' => 'botol', 'jumlah' => 80],
            ['nama' => 'NESTLE Botol 600ml',    'file' => 'NESTLE BOTOL.jpeg',   'kategori' => 'botol', 'harga' => 5500,  'supplier' => 'PT Nestle Indonesia',  'kode' => 'BA-003', 'satuan' => 'botol', 'jumlah' => 60],
            ['nama' => 'AQUVIVA Botol 600ml',   'file' => 'AQUVIVA BOTOL.jpeg',  'kategori' => 'botol', 'harga' => 4500,  'supplier' => 'PT Aquviva Nusantara', 'kode' => 'BA-004', 'satuan' => 'botol', 'jumlah' => 70],
            ['nama' => 'PRISTEN Botol 600ml',   'file' => 'PRISTEN BOTOL.jpeg',  'kategori' => 'botol', 'harga' => 6000,  'supplier' => 'PT Pristine Water',    'kode' => 'BA-005', 'satuan' => 'botol', 'jumlah' => 50],
            ['nama' => 'CRISTALYN Botol 600ml', 'file' => 'CRISTALYN BOTOL.jpg', 'kategori' => 'botol', 'harga' => 5000,  'supplier' => 'PT Cristalyn Water',   'kode' => 'BA-006', 'satuan' => 'botol', 'jumlah' => 90],
            ['nama' => 'CRISTALYN Galon 19L',   'file' => 'CRISTALYN GALON.jpg', 'kategori' => 'galon', 'harga' => 22000, 'supplier' => 'PT Cristalyn Water',   'kode' => 'BA-007', 'satuan' => 'galon', 'jumlah' => 40],
            ['nama' => 'VIT Galon 19L',         'file' => 'VIT GALON.jpeg',      'kategori' => 'galon', 'harga' => 20000, 'supplier' => 'PT Tirta Fresindo',    'kode' => 'BA-008', 'satuan' => 'galon', 'jumlah' => 35],
            ['nama' => 'NESTLE Galon 19L',      'file' => 'NESTLE GALON.jpeg',   'kategori' => 'galon', 'harga' => 24000, 'supplier' => 'PT Nestle Indonesia',  'kode' => 'BA-009', 'satuan' => 'galon', 'jumlah' => 30],
            ['nama' => 'PRISTINE Galon 19L',    'file' => 'PRISTINE GALON.jpg',  'kategori' => 'galon', 'harga' => 25000, 'supplier' => 'PT Pristine Water',    'kode' => 'BA-010', 'satuan' => 'galon', 'jumlah' => 25],
        ];
        foreach($products as $p) {
            Barang::create([
                'user_id'  => $adminId,
                'kode'     => $p['kode'],
                'nama'     => $p['nama'],
                'kategori' => $p['kategori'],
                'jumlah'   => $p['jumlah'],
                'satuan'   => $p['satuan'],
                'harga'    => $p['harga'],
                'supplier' => $p['supplier'],
                'tanggal'  => now()->toDateString(),
                'foto'     => 'produk/' . $p['file'],
            ]);
        }
    }
}