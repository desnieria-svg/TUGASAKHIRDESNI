<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('pesanans', function (Blueprint $table) {
            if (!Schema::hasColumn('pesanans', 'user_id'))
                $table->unsignedBigInteger('user_id')->nullable()->after('id');
            if (!Schema::hasColumn('pesanans', 'metode_bayar'))
                $table->enum('metode_bayar', ['qris','transfer_bca','transfer_bni','transfer_mandiri','transfer_bri','cod'])->default('qris')->after('total_harga');
            if (!Schema::hasColumn('pesanans', 'bukti_bayar'))
                $table->string('bukti_bayar')->nullable()->after('metode_bayar');
            if (!Schema::hasColumn('pesanans', 'catatan'))
                $table->text('catatan')->nullable()->after('bukti_bayar');
            if (!Schema::hasColumn('pesanans', 'kode_pesanan'))
                $table->string('kode_pesanan')->nullable()->after('id');
        });
    }
    public function down(): void {}
};
