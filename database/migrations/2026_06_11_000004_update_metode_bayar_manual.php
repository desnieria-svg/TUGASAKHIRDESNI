<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('pesanans')) return;
        $driver = DB::getDriverName();
        if ($driver === 'pgsql') {
            DB::statement("ALTER TABLE pesanans ALTER COLUMN metode_bayar TYPE VARCHAR(30)");
            DB::statement("ALTER TABLE pesanans ALTER COLUMN metode_bayar SET DEFAULT 'qris'");
            DB::statement("ALTER TABLE pesanans ALTER COLUMN metode_bayar SET NOT NULL");
        } elseif ($driver !== 'sqlite') {
            DB::statement("ALTER TABLE pesanans MODIFY metode_bayar VARCHAR(30) NOT NULL DEFAULT 'qris'");
        }
        if (!Schema::hasColumn('pesanans', 'konfirmasi_bayar')) {
            Schema::table('pesanans', function (Blueprint $table) {
                $table->string('konfirmasi_bayar', 20)->default('menunggu')->after('bukti_bayar');
            });
        }
    }
    public function down(): void {}
};