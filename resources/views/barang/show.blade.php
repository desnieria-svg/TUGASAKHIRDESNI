@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detail Produk</h5>
                    <a href="{{ route('barang.index') }}" class="btn btn-sm btn-light">← Kembali</a>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        @if($barang->foto)
                            <img src="{{ asset('storage/' . $barang->foto) }}" width="150" height="150"
                                style="object-fit:cover; border-radius:10px;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center rounded"
                                style="width:150px;height:150px;margin:auto;">
                                <span class="text-muted">Tidak ada foto</span>
                            </div>
                        @endif
                    </div>

                    <table class="table table-bordered">
                        <tr>
                            <th width="35%">Kode Produk</th>
                            <td>{{ $barang->kode }}</td>
                        </tr>
                        <tr>
                            <th>Nama Produk</th>
                            <td>{{ $barang->nama }}</td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td><span class="badge bg-info text-dark">{{ ucfirst($barang->kategori) }}</span></td>
                        </tr>
                        <tr>
                            <th>Stok</th>
                            <td>{{ $barang->jumlah }} {{ $barang->satuan }}</td>
                        </tr>
                        <tr>
                            <th>Harga</th>
                            <td>Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Supplier</th>
                            <td>{{ $barang->supplier }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Masuk</th>
                            <td>{{ \Carbon\Carbon::parse($barang->tanggal)->format('d F Y') }}</td>
                        </tr>
                    </table>

                    <div class="d-flex gap-2 mt-3">
                        <a href="{{ route('barang.edit', $barang) }}" class="btn btn-warning">Edit Produk</a>
                        <form action="{{ route('barang.destroy', $barang) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                data-confirm="Produk &quot;{{ addslashes($barang->nama) }}&quot; akan dihapus secara permanen dan tidak dapat dikembalikan."
                                data-confirm-title="Hapus Produk?"
                                data-confirm-icon="🗑️"
                                data-confirm-ok="Ya, Hapus">
                                Hapus Produk
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection