<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Kota;
use App\Models\Pelanggan;
use App\Models\Pesanan;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $pesanan->status = "jemput";
        $pesanan->percentage = 0;
        $pesanan->save();

        $status = new Status;
        $status->pesanan_id = $pesanan->id;
        $status->user_id = Auth::user()->id;
        $status->keterangan = "Pesanan telah dibuat";
        $status->save();

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

        $status = Status::where('pesanan_id', $request->id);
        $status->delete();

        return response()->json([
            'status' => 200
        ]);
    }

    public function status(Request $request)
    {

        if ($request->value == "jemput") {
            $status = "terima";
            $keterangan = "Berkas sedang di ambil";
            $percentage = 17;
        } else if ($request->value == "terima") {
            $status = "proses";
            $keterangan = "Berkas sudah diterima";
            $percentage = 34;
        } else if ($request->value == "proses") {
            $status = "selesai";
            $keterangan = "Berkas sedang diproses di Samsat";
            $percentage = 51;
        } else if ($request->value == "selesai") {
            $status = "antar";
            $keterangan = "Berkas sudah selesai dari Samsat";
            $percentage = 68;
        } else if ($request->value == "antar") {
            $status = "sampai";
            $keterangan = "Berkas sedang diantar ke pelanggan";
            $percentage = 85;
        } else if ($request->value == "sampai") {
            $status = "done";
            $keterangan = "Berkasi sudah sampai ke tangan pelanggan";
            $percentage = 100;
        } else {
            $status = "null";
            $keterangan = "Selesai";
            $percentage = 0;
        }

        $pesanan = Pesanan::find($request->id);
        $pesanan->status = $status;
        $pesanan->percentage = $percentage;
        $pesanan->save();

        $status_pesanan = new Status;
        $status_pesanan->pesanan_id = $pesanan->id;
        $status_pesanan->user_id = Auth::user()->id;
        $status_pesanan->keterangan = $keterangan;
        $status_pesanan->save();

        return response()->json([
            'status' => 200
        ]);
    }

    public function statusDetail($id)
    {
        $status_detail = Status::where('pesanan_id', $id)->get();

        return response()->json([
            'status_details' => $status_detail
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
