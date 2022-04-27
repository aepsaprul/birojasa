<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Kota;
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

    public function create($id)
    {
        $kategori = Kategori::find($id);
        $pelanggan = Pelanggan::get();
        $kota = Kota::get();

        return view('pages.pesanan.create', [
            'kategori' => $kategori,
            'pelanggans' => $pelanggan,
            'kotas' => $kota
        ]);
    }

    public function store(Request $request)
    {
        $pesanan = new Pesanan;
        $pesanan->kategori_id = $request->kategori_id;
        $pesanan->pelanggan_id = $request->pelanggan_id;
        $pesanan->pemilik = $request->pemilik;
        $pesanan->jenis = $request->jenis;
        $pesanan->tahun = $request->tahun;
        $pesanan->plat_nomor = $request->plat_nomor;
        $pesanan->pkb_berlaku = $request->pkb_berlaku;
        $pesanan->pkb_nominal = $request->pkb_nominal;
        $pesanan->swdkllj = $request->swdkllj;
        $pesanan->samsat_asal = $request->samsat_asal;
        $pesanan->samsat_tujuan = $request->samsat_tujuan;
        $pesanan->save();

        return response()->json([
            'status' => 200
        ]);
    }

    public function show($id)
    {
    $pesanan = Pesanan::with(['kategori', 'pelanggan', 'samsatAsal', 'samsatTujuan'])->find($id);

        return response()->json([
            'pesanan' => $pesanan
        ]);
    }

    public function edit($id)
    {
        $pesanan = Pesanan::with('kategori', 'pelanggan', 'samsatAsal', 'samsatTujuan')->find($id);
        $kategori = Kategori::get();
        $pelanggan = Pelanggan::get();
        $kota = Kota::get();

        return response()->json([
            'pesanan' => $pesanan,
            'kategoris' => $kategori,
            'pelanggans' => $pelanggan,
            'kotas' => $kota
        ]);
    }

    public function update(Request $request)
    {
        $pesanan = Pesanan::find($request->id);
        $pesanan->kategori_id = $request->kategori_id;
        $pesanan->pelanggan_id = $request->pelanggan_id;
        $pesanan->pemilik = $request->pemilik;
        $pesanan->jenis = $request->jenis;
        $pesanan->tahun = $request->tahun;
        $pesanan->plat_nomor = $request->plat_nomor;
        $pesanan->pkb_berlaku = $request->pkb_berlaku;
        $pesanan->pkb_nominal = $request->pkb_nominal;
        $pesanan->swdkllj = $request->swdkllj;
        $pesanan->samsat_asal = $request->samsat_asal;
        $pesanan->samsat_tujuan = $request->samsat_tujuan;
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

    public function pelangganStore(Request $request)
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

    public function kotaStore(Request $request)
    {
        $kota = new Kota;
        $kota->nama = $request->nama;
        $kota->save();

        return response()->json([
            'status' => 200
        ]);
    }
}
