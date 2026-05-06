<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
{
    $users = User::with('jabatan')->get();

    return view('admin.users.index', compact('users'));
}

public function create()
{
    $jabatans = Jabatan::all();

    return view('admin.users.create', compact('jabatans'));
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'role' => 'required',
        'jabatan_id' => 'required'
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
        'jabatan_id' => $request->jabatan_id,
        'sisa_kuota_lembur' => 50 // default
    ]);

    return redirect('/admin/users')->with('success', 'Karyawan berhasil ditambahkan');
}

public function edit($id)
{
    $user = User::findOrFail($id);
    $jabatans = Jabatan::all();

    return view('admin.users.edit', compact('user', 'jabatans'));
}
public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
        'jabatan_id' => $request->jabatan_id,
    ]);

    return redirect('/admin/users')->with('success', 'Data berhasil diupdate');
}

public function destroy($id)
{
    User::findOrFail($id)->delete();

    return back()->with('success', 'Karyawan berhasil dihapus');
}
}
