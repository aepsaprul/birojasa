<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use Illuminate\Http\Request;

class KotaController extends Controller
{
    public function index()
    {
        $kota = Kota::limit(500)->get();

        return view('pages.master.kota.index', ['kotas' => $kota]);
    }

    public function store(Request $request)
    {
        $kota = new Kota;
        $kota->nama = $request->nama;
        $kota->save();

        return response()->json([
            'status' => 200
        ]);
    }

    public function edit($id)
    {
        $kota = Kota::find($id);

        return response()->json([
            'kota' => $kota
        ]);
    }

    public function update(Request $request)
    {
        $kota = Kota::find($request->id);
        $kota->nama = $request->nama;
        $kota->save();

        return response()->json([
            'status' => 200
        ]);
    }

    public function deleteBtn($id)
    {
        $kota = Kota::find($id);

        return response()->json([
            'id' => $kota->id
        ]);
    }

    public function delete(Request $request)
    {
        $kota = Kota::find($request->id);
        $kota->delete();

        return response()->json([
            'status' => 200
        ]);
    }
}
