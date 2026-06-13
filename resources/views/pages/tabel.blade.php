<section class="tabel">
<h2>Data Barang</h2>

<table>
<tr>
  <th>Kode</th>
  <th>Nama</th>
  <th>Kategori</th>
  <th>Jumlah</th>
</tr>

@foreach($barang as $item)
<tr>
  <td>{{ $item->kode }}</td>
  <td>{{ $item->nama }}</td>
  <td>{{ $item->kategori }}</td>
  <td>{{ $item->jumlah }}</td>
</tr>
@endforeach

</table>
</section>
