<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('pesanans', function (Blueprint $table) {
            if (!Schema::hasColumn('pesanans', 'jenis_pengiriman'))
                $table->enum('jenis_pengiriman', ['jemput', 'antar'])->default('antar')->after('catatan');
            if (!Schema::hasColumn('pesanans', 'kecamatan'))
                $table->string('kecamatan')->nullable()->after('jenis_pengiriman');
            if (!Schema::hasColumn('pesanans', 'kelurahan'))
                $table->string('kelurahan')->nullable()->after('kecamatan');
            if (!Schema::hasColumn('pesanans', 'rt_rw'))
                $table->string('rt_rw')->nullable()->after('kelurahan');
            if (!Schema::hasColumn('pesanans', 'midtrans_order_id'))
                $table->string('midtrans_order_id')->nullable()->after('kode_pesanan');
            if (!Schema::hasColumn('pesanans', 'midtrans_token'))
                $table->text('midtrans_token')->nullable()->after('midtrans_order_id');
        });
    }
    public function down(): void {}
};
