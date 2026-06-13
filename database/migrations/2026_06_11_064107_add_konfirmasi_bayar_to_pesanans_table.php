<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pesanans', function (Blueprint $table) {
            $table->enum('konfirmasi_bayar', [
                'menunggu',
                'diterima',
                'ditolak'
            ])->default('menunggu')->after('bukti_bayar');
        });
    }

    public function down(): void
    {
        Schema::table('pesanans', function (Blueprint $table) {
            $table->dropColumn('konfirmasi_bayar');
        });
    }
};