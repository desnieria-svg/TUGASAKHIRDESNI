<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        // Admin
        User::firstOrCreate(['email' => 'admin@bioaqua.lab'], [
            'name'     => 'Admin BioAqua',
            'password' => Hash::make('admin123'),
            'role'     => 'admin',
        ]);
        // User demo
        User::firstOrCreate(['email' => 'user@bioaqua.lab'], [
            'name'     => 'Pelanggan Demo',
            'password' => Hash::make('user123'),
            'role'     => 'user',
        ]);

        $this->call(BarangSeeder::class);
    }
}
