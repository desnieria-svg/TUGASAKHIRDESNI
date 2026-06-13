<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    // BONUS - Hanya tampilkan barang milik user yang login
    public function index()
    {
        $barangs = Barang::where('user_id', auth()->id())->paginate(10);
        return view('barang.index', compact('barangs'));
    }

    public function create()
    {
        return view('barang.create');
    }

    // Simpan + otomatis isi user_id
    public function store(Request $request)
    {
        $request->validate([
            'kode'     => 'required|unique:barangs,kode',
            'nama'     => 'required|min:3',
            'kategori' => 'required|in:galon,botol,cup',
            'jumlah'   => 'required|integer|min:0',
            'satuan'   => 'required',
            'harga'    => 'required|numeric|min:0',
            'supplier' => 'required',
            'tanggal'  => 'required|date',
            'foto'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except('foto');
        $data['user_id'] = auth()->id();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('produk', 'public');
        }

        Barang::create($data);

        return redirect()->route('barang.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function show(Barang $barang)
    {
        return view('barang.show', compact('barang'));
    }

    public function edit(Barang $barang)
    {
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'kode'     => 'required|unique:barangs,kode,' . $barang->id,
            'nama'     => 'required|min:3',
            'kategori' => 'required|in:galon,botol,cup',
            'jumlah'   => 'required|integer|min:0',
            'satuan'   => 'required',
            'harga'    => 'required|numeric|min:0',
            'supplier' => 'required',
            'tanggal'  => 'required|date',
            'foto'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            if ($barang->foto) {
                Storage::disk('public')->delete($barang->foto);
            }
            $data['foto'] = $request->file('foto')->store('produk', 'public');
        }

        $barang->update($data);

        return redirect()->route('barang.index')
            ->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Barang $barang)
    {
        if ($barang->foto) {
            Storage::disk('public')->delete($barang->foto);
        }

        $barang->delete();

        return redirect()->route('barang.index')
            ->with('success', 'Produk berhasil dihapus!');
    }

    public function search(Request $request)
    {
        $keyword = $request->get('keyword', '');

        $barangs = Barang::where(function ($query) use ($keyword) {
                $query->where('nama', 'LIKE', '%' . $keyword . '%')
                      ->orWhere('kode', 'LIKE', '%' . $keyword . '%')
                      ->orWhere('kategori', 'LIKE', '%' . $keyword . '%');
            })
            ->get();

        return response()->json($barangs);
    }
} 