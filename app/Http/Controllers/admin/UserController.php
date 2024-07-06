<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.a_user.index', [
            'user' => User::orderByRaw("
                FIELD(peran, 'pimpinan','admin', 'staff', 'dosen', 'mahasiswa')
            ")->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.a_user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->validated();

        $data = User::create($data);
        if ($data) {
            return to_route('user.index')->with('success', 'Berhasil Menambah Data');
        } else {
            return to_route('user.index')->with('failed', 'Gagal Menambah Data');
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
        // return view('admin.a_user.edit', [
        //     'user' => User::find($id)
        // ]);
        $user = User::findOrFail($id);
        return view('admin.a_user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $data = $request->validated();

        $user = User::find($id)->update($data);
        if ($user) {
            return to_route('user.index')->with('success', 'Berhasil Mengubah Data');
        } else {
            return to_route('user.index')->with('failed', 'Gagal Mengubah Data');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = User::find($id);
        $data->delete();

        if ($id) {
            return to_route('user.index')->with('success', 'Berhasil Menghapus Data');
        } else {
            return to_route('user.index')->with('failed', 'Gagal Menghapus Data');
        }
    }
}
