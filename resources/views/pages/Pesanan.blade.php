<section class="pesanan" id="pesanan">
<h2>Form Pesanan</h2>

<form method="POST" action="/pesanan" class="form">
@csrf

<input name="kodeBarang" placeholder="Kode">
<input name="namaBarang" placeholder="Nama">
<input name="kategori" placeholder="Kategori">
<input name="jumlah" type="number" placeholder="Jumlah">
<input name="satuan" placeholder="Satuan">
<input name="harga" type="number" placeholder="Harga">
<input name="supplier" placeholder="Supplier">
<input name="tanggalMasuk" type="date">

<button type="submit">Simpan</button>

</form>
</section>
