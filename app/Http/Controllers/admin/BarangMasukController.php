<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\Supplier;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.a_barang_masuk.index', [
            'barangmasuk' => BarangMasuk::with('barangs','suppliers')->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.a_barang_masuk.create', [
            'barang' => Barang::get(),
            'supplier' => Supplier::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'barangs_id'   => 'required',
            'suppliers_id'=> 'required',
            'jumlah_barang' => 'required|integer|min:0',
            'tanggal_masuk' => 'required'
        ]);

        $barangmasuk = BarangMasuk::create($data);
        if ($barangmasuk) {
            return to_route('barangmasuk.index')->with('success', 'Berhasil Menambah Data');
        } else {
            return to_route('barangmasuk.index')->with('failed', 'Gagal Menambah Data');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.a_barang_masuk.edit', [
            'barangmasuk' => BarangMasuk::find($id),
            'barang' => Barang::get(),
            'supplier' => Supplier::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $barangmasuk = BarangMasuk::findOrFail($id);

        $data = $request->validate([
            'barangs_id'   => 'required',
            'suppliers_id'=> 'required',
            'jumlah_barang' => 'required|integer|min:0',
            'tanggal_masuk' => 'required'
        ]);

        $barangmasuk->update($data);
        if ($barangmasuk) {
            return to_route('barangmasuk.index')->with('success', 'Berhasil Menyimpan Data');
        } else {
            return to_route('barangmasuk.index')->with('failed', 'Gagal Menyimpan Data');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $barangmasuk = BarangMasuk::find($id)->delete();
        if ($barangmasuk) {
            return to_route('barangmasuk.index')->with('success', 'Berhasil Menghapus Data');
        } else {
            return to_route('barangmasuk.index')->with('failed', 'Gagal Menghapus Data');
        }
    }
}
