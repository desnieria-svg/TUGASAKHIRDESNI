<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('pesanans', 'konfirmasi_bayar')) {
            Schema::table('pesanans', function (Blueprint $table) {
                $table->string('konfirmasi_bayar')->default('menunggu');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('pesanans', 'konfirmasi_bayar')) {
            Schema::table('pesanans', function (Blueprint $table) {
                $table->dropColumn('konfirmasi_bayar');
            });
        }
    }
};