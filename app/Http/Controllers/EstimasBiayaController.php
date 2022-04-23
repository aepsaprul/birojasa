<?php

namespace App\Http\Controllers;

use App\Models\EstimasiBiaya;
use App\Models\Kategori;
use Illuminate\Http\Request;

class EstimasBiayaController extends Controller
{
    public function index()
    {
        $estimasi_biaya = EstimasiBiaya::limit(500)->get();

        return view('pages.master.estimasi_biaya.index', ['estimasi_biayas' => $estimasi_biaya]);
    }

    public function create()
    {
        $kategori = Kategori::get();

        return response()->json([
            'kategoris' => $kategori
        ]);
    }

    public function store(Request $request)
    {
        $estimasi_biaya = new EstimasiBiaya;
        $estimasi_biaya->kategori_id = $request->kategori_id;
        $estimasi_biaya->antar = str_replace(".", "", $request->antar);
        $estimasi_biaya->jemput = str_replace(".", "", $request->jemput);
        $estimasi_biaya->jasa = str_replace(".", "", $request->jasa);
        $estimasi_biaya->administrasi = str_replace(".", "", $request->administrasi);
        $estimasi_biaya->bpkb = str_replace(".", "", $request->bpkb);
        $estimasi_biaya->stnk = str_replace(".", "", $request->stnk);
        $estimasi_biaya->tnkb = str_replace(".", "", $request->tnkb);
        $estimasi_biaya->save();

        return response()->json([
            'status' => 200
        ]);
    }

    public function edit($id)
    {
        $estimasi_biaya = EstimasiBiaya::find($id);
        $kategori = Kategori::get();

        return response()->json([
            'estimasi_biaya' => $estimasi_biaya,
            'kategoris' => $kategori
        ]);
    }

    public function update(Request $request)
    {
        $estimasi_biaya = EstimasiBiaya::find($request->id);
        $estimasi_biaya->kategori_id = $request->kategori_id;
        $estimasi_biaya->antar = str_replace(".", "", $request->antar);
        $estimasi_biaya->jemput = str_replace(".", "", $request->jemput);
        $estimasi_biaya->jasa = str_replace(".", "", $request->jasa);
        $estimasi_biaya->administrasi = str_replace(".", "", $request->administrasi);
        $estimasi_biaya->bpkb = str_replace(".", "", $request->bpkb);
        $estimasi_biaya->stnk = str_replace(".", "", $request->stnk);
        $estimasi_biaya->tnkb = str_replace(".", "", $request->tnkb);
        $estimasi_biaya->save();

        return response()->json([
            'status' => 200
        ]);
    }

    public function deleteBtn($id)
    {
        $estimasi_biaya = EstimasiBiaya::find($id);

        return response()->json([
            'id' => $estimasi_biaya->id
        ]);
    }

    public function delete(Request $request)
    {
        $estimasi_biaya = EstimasiBiaya::find($request->id);
        $estimasi_biaya->delete();

        return response()->json([
            'status' => 200
        ]);
    }
}
