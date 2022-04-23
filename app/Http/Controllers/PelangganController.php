<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::limit(500)->get();

        return view('pages.pelanggan.index', ['pelanggans' => $pelanggan]);
    }

    public function store(Request $request)
    {
        $pelanggan = new Pelanggan;
        $pelanggan->nama = $request->nama;
        $pelanggan->telepon = $request->telepon;
        $pelanggan->email = $request->email;
        $pelanggan->alamat = $request->alamat;
        $pelanggan->save();

        return response()->json([
            'status' => 200
        ]);
    }

    public function edit($id)
    {
        $pelanggan = Pelanggan::find($id);

        return response()->json([
            'pelanggan' => $pelanggan
        ]);
    }

    public function update(Request $request)
    {
        $pelanggan = Pelanggan::find($request->id);
        $pelanggan->nama = $request->nama;
        $pelanggan->telepon = $request->telepon;
        $pelanggan->email = $request->email;
        $pelanggan->alamat = $request->alamat;
        $pelanggan->save();

        return response()->json([
            'status' => 200
        ]);
    }

    public function deleteBtn($id)
    {
        $pelanggan = Pelanggan::find($id);

        return response()->json([
            'id' => $pelanggan->id
        ]);
    }

    public function delete(Request $request)
    {
        $pelanggan = Pelanggan::find($request->id);
        $pelanggan->delete();

        return response()->json([
            'status' => 200
        ]);
    }
}
