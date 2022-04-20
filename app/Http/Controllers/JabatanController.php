<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index()
    {
        $jabatan = Jabatan::get();

        return view('pages.master.jabatan.index', ['jabatans' => $jabatan]);
    }

    public function store(Request $request)
    {
        $jabatan = new Jabatan;
        $jabatan->nama = $request->nama;
        $jabatan->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function edit($id)
    {
        $jabatan = Jabatan::find($id);

        return response()->json([
            'id' => $jabatan->id,
            'nama' => $jabatan->nama
        ]);
    }

    public function update(Request $request, $id)
    {
        $jabatan = Jabatan::find($id);
        $jabatan->nama = $request->nama;
        $jabatan->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function deleteBtn($id)
    {
        $jabatan = Jabatan::find($id);

        return response()->json([
            'id' => $jabatan->id
        ]);
    }

    public function delete(Request $request)
    {
        $jabatan = Jabatan::find($request->id);
        $jabatan->delete();

        return response()->json([
            'status' => 'true'
        ]);
    }
}
