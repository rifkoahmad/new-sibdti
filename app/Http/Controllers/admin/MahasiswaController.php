<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\MahasiswaRequest;
use App\Http\Requests\UpdateMahasiswaRequest;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.a_mahasiswa.index', [
            'mahasiswa' => Mahasiswa::with('prodis','users')->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.a_mahasiswa.create', [
            'prodis' =>Prodi::get(),
            'users' =>User::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MahasiswaRequest $request)
    {
        $data = $request->validated();

        $mahasiswa = Mahasiswa::create($data);
        if ($mahasiswa) {
            return to_route('mahasiswa.index')->with('success', 'Berhasil Menambah Data');
        } else {
            return to_route('mahasiswa.index')->with('failed', 'Gagal Menambah Data');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('admin.a_mahasiswa.detail', compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.a_mahasiswa.edit', [
            'mahasiswa' => Mahasiswa::find($id),
            'prodis' => Prodi::get(),
            'users' => User::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMahasiswaRequest $request, string $id)
    {
        $data = $request->validated();

        $mahasiswa = Mahasiswa::find($id)->update($data);
        if ($mahasiswa) {
            return to_route('mahasiswa.index')->with('success', 'Berhasil Mengubah Data');
        } else {
            return to_route('mahasiswa.index')->with('failed', 'Gagal Mengubah Data');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Mahasiswa::find($id);

        $data->delete();

        if ($id) {
            return to_route('mahasiswa.index')->with('success', 'Berhasil Menghapus Data');
        } else {
            return to_route('mahasiswa.index')->with('failed', 'Gagal Menghapus Data');
        }
    }
}
