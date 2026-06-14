<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('pesanans')) return;
        if (!Schema::hasColumn('pesanans', 'metode_bayar')) return;
        $driver = DB::getDriverName();
        if ($driver === 'sqlite') {
            Schema::table('pesanans', function (Blueprint $table) {
                $table->string('metode_bayar_new')->nullable()->after('metode_bayar');
            });
            DB::statement("UPDATE pesanans SET metode_bayar_new = CASE
                WHEN metode_bayar = 'qris' THEN 'midtrans'
                WHEN metode_bayar LIKE 'transfer_%' THEN 'midtrans'
                WHEN metode_bayar = 'cod' THEN 'cod'
                WHEN metode_bayar = 'midtrans' THEN 'midtrans'
                ELSE 'midtrans'
            END");
            Schema::table('pesanans', function (Blueprint $table) {
                $table->dropColumn('metode_bayar');
            });
            Schema::table('pesanans', function (Blueprint $table) {
                $table->renameColumn('metode_bayar_new', 'metode_bayar');
            });
        } elseif ($driver === 'pgsql') {
            DB::statement("ALTER TABLE pesanans ALTER COLUMN metode_bayar TYPE VARCHAR(30)");
            DB::statement("ALTER TABLE pesanans ALTER COLUMN metode_bayar SET DEFAULT 'midtrans'");
            DB::statement("ALTER TABLE pesanans ALTER COLUMN metode_bayar SET NOT NULL");
        } else {
            DB::statement("ALTER TABLE pesanans MODIFY metode_bayar VARCHAR(30) NOT NULL DEFAULT 'midtrans'");
        }
    }
    public function down(): void {}
};