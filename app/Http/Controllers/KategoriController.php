<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::limit(500)->get();

        return view('pages.master.kategori.index', ['kategoris' => $kategori]);
    }

    public function store(Request $request)
    {
        $kategori = new Kategori;
        $kategori->nama = $request->nama;
        $kategori->persyaratan = $request->persyaratan;
        $kategori->save();

        return response()->json([
            'status' => 200
        ]);
    }

    public function edit($id)
    {
        $kategori = Kategori::find($id);

        return response()->json([
            'kategori' => $kategori
        ]);
    }

    public function update(Request $request)
    {
        $kategori = Kategori::find($request->id);
        $kategori->nama = $request->nama;
        $kategori->persyaratan = $request->persyaratan;
        $kategori->save();

        return response()->json([
            'status' => 200
        ]);
    }

    public function deleteBtn($id)
    {
        $kategori = Kategori::find($id);

        return response()->json([
            'id' => $kategori->id
        ]);
    }

    public function delete(Request $request)
    {
        $kategori = Kategori::find($request->id);
        $kategori->delete();

        return response()->json([
            'status' => 200
        ]);
    }
}
