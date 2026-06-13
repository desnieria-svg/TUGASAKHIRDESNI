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

        // Update metode_bayar to support manual payment methods
        if ($driver === 'sqlite') {
            // SQLite: just ensure the column accepts any string value
            if (Schema::hasColumn('pesanans', 'metode_bayar')) {
                // Column already exists as varchar after previous migration, no action needed
            }
        } else {
            DB::statement("ALTER TABLE pesanans MODIFY metode_bayar VARCHAR(30) NOT NULL DEFAULT 'qris'");
        }

        // Add konfirmasi_bayar column
        if (!Schema::hasColumn('pesanans', 'konfirmasi_bayar')) {
            Schema::table('pesanans', function (Blueprint $table) {
                $table->string('konfirmasi_bayar', 20)->default('menunggu')->after('bukti_bayar');
            });
        }
    }
    public function down(): void {}
};
