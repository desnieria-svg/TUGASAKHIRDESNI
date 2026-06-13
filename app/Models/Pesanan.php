<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Pesanan extends Model
{
    protected $fillable = [
        'user_id','kode_pesanan','midtrans_order_id','midtrans_token',
        'nama_pelanggan','alamat','no_hp',
        'nama_produk','kategori','jumlah','harga_satuan','total_harga',
        'metode_bayar','bukti_bayar','catatan',
        'jenis_pengiriman','kecamatan','kelurahan','rt_rw',
        'status','tanggal_pesan','konfirmasi_bayar',
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function barangs() {
        return $this->belongsToMany(Barang::class, 'barang_pesanan')
                    ->withPivot('jumlah')->withTimestamps();
    }
    public function scopeMenunggu(Builder $q): Builder { return $q->where('status','menunggu'); }
    public function scopeProses(Builder $q): Builder   { return $q->where('status','proses'); }
    public function scopeSelesai(Builder $q): Builder  { return $q->where('status','selesai'); }
    public function scopeBatal(Builder $q): Builder    { return $q->where('status','batal'); }

    public static function generateKode(): string {
        $last = self::latest()->first();
        $num  = $last ? ((int) substr($last->kode_pesanan ?? 'ORD-000', 4)) + 1 : 1;
        return 'ORD-' . str_pad($num, 4, '0', STR_PAD_LEFT);
    }
}
