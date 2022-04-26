<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pelanggan;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::limit(500)->orderBy('id', 'desc')->get();
        $kategori = Kategori::get();

        return view('pages.pesanan.index', ['pesanans' => $pesanan, 'kategoris' => $kategori]);
    }

    public function create()
    {
        $kategori = Kategori::get();
        $pelanggan = Pelanggan::get();

        return view('pages.pesanan.create', ['kategori' => $kategori, 'pelanggan' => $pelanggan]);
    }

    public function store(Request $request)
    {
        $pesanan = new Pesanan;
        $pesanan->nama = $request->nama;
        $pesanan->telepon = $request->telepon;
        $pesanan->email = $request->email;
        $pesanan->alamat = $request->alamat;
        $pesanan->save();

        return response()->json([
            'status' => 200
        ]);
    }

    public function edit($id)
    {
        $pesanan = Pesanan::find($id);

        return response()->json([
            'pesanan' => $pesanan
        ]);
    }

    public function update(Request $request)
    {
        $pesanan = Pesanan::find($request->id);
        $pesanan->nama = $request->nama;
        $pesanan->telepon = $request->telepon;
        $pesanan->email = $request->email;
        $pesanan->alamat = $request->alamat;
        $pesanan->save();

        return response()->json([
            'status' => 200
        ]);
    }

    public function deleteBtn($id)
    {
        $pesanan = Pesanan::find($id);

        return response()->json([
            'id' => $pesanan->id
        ]);
    }

    public function delete(Request $request)
    {
        $pesanan = Pesanan::find($request->id);
        $pesanan->delete();

        return response()->json([
            'status' => 200
        ]);
    }

    public function tambah($id)
    {
        $kategori = Kategori::find($id);
        $pelanggan = Pelanggan::get();

        return view('pages.pesanan.create', ['kategori' => $kategori, 'pelanggans' => $pelanggan]);
    }
}
