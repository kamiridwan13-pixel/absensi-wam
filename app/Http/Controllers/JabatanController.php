<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
class JabatanController extends Controller
{
    public function index()
{
    $jabatans = Jabatan::all();
    return view('admin.jabatan.index', compact('jabatans'));
}

public function create()
{
    return view('admin.jabatan.create');
}

public function store(Request $request)
{
    $request->validate([
        'nama' => 'required',
        'rate_per_jam' => 'required|numeric'
    ]);

    Jabatan::create($request->all());

    return redirect('/admin/jabatan')->with('success', 'Jabatan berhasil ditambahkan');
}

public function edit($id)
{
    $jabatan = Jabatan::findOrFail($id);
    return view('admin.jabatan.edit', compact('jabatan'));
}

public function update(Request $request, $id)
{
    $jabatan = Jabatan::findOrFail($id);

    $jabatan->update($request->all());

    return redirect('/admin/jabatan')->with('success', 'Jabatan berhasil diupdate');
}

public function destroy($id)
{
    Jabatan::findOrFail($id)->delete();

    return back()->with('success', 'Jabatan berhasil dihapus');
}
}
