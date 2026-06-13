<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        $driver = DB::getDriverName();

        foreach (['barangs', 'pesanans'] as $table) {
            if (!Schema::hasTable($table) || !Schema::hasColumn($table, 'kategori')) continue;

            if ($driver === 'sqlite') {
                Schema::table($table, function (Blueprint $t) {
                    $t->string('kategori_new')->nullable()->after('kategori');
                });

                DB::statement("UPDATE {$table} SET kategori_new = CASE
                    WHEN kategori = 'jerigen' THEN 'galon'
                    ELSE kategori
                END");

                Schema::table($table, function (Blueprint $t) {
                    $t->dropColumn('kategori');
                });

                Schema::table($table, function (Blueprint $t) {
                    $t->renameColumn('kategori_new', 'kategori');
                });
            } else {
                DB::statement("UPDATE {$table} SET kategori = 'galon' WHERE kategori = 'jerigen'");
                DB::statement("ALTER TABLE {$table} MODIFY kategori VARCHAR(20) NOT NULL");
            }
        }
    }

    public function down(): void {}
};
