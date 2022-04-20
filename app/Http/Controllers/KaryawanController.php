<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::orderBy('id', 'desc')->get();

        return view('pages.karyawan.index', ['karyawans' => $karyawan]);
    }

    public function create()
    {
        $jabatan = Jabatan::get();

        return response()->json([
            'jabatans' => $jabatan
        ]);
    }

    public function store(Request $request)
    {
        $messages = [
            'nama_lengkap.required' => 'Nama lengkap harus diisi',
            'nama_panggilan.required' => 'Nama panggilan harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email harus diisi dengan tipe email',
            'email.unique' => 'Email sudah dipakai',
            'email.max' => 'Email diisi makasimal 50 karakter',
            'telepon.required' => 'Telepon harus diisi',
            'telepon.unique' => 'Telepon sudah terpakai',
            'telepon.max' => 'Telepon diisi maksimal 15 karakter',
            'jabatan_id.required' => 'Jabatan harus diisi',
            'gender.required' => 'Jenis kelamin harus diisi',
            'gender.max' => 'Jenis kelamin diisi maksimal 1 karakter',
            'alamat.required' => 'Alamat harus diisi',
        ];

        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|max:30',
            'nama_panggilan' => 'required|max:15',
            'telepon' => 'required|unique:karyawans|max:15',
            'email' => 'required|email|unique:karyawans|max:50',
            'gender' => 'required|max:1',
            'alamat' => 'required',
            'jabatan_id' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {
            $karyawan = new Karyawan;
            $karyawan->nama_lengkap = $request->nama_lengkap;
            $karyawan->nama_panggilan = $request->nama_panggilan;
            $karyawan->telepon = $request->telepon;
            $karyawan->email = $request->email;
            $karyawan->gender = $request->gender;
            $karyawan->alamat = $request->alamat;
            $karyawan->jabatan_id = $request->jabatan_id;
            $karyawan->status = "aktif";
            $karyawan->save();

            return response()->json([
                'status' => 200,
                'message' => "Data berhasil ditambahkan"
            ]);
        }
    }

    public function show($id)
    {
        $karyawan = Karyawan::find($id);

        return response()->json([
            'id' => $karyawan->id,
            'nama_lengkap' => $karyawan->nama_lengkap,
            'nama_panggilan' => $karyawan->nama_panggilan,
            'email' => $karyawan->email,
            'telepon' => $karyawan->telepon,
            'gender' => $karyawan->gender,
            'alamat' => $karyawan->alamat,
            'jabatan' => $karyawan->jabatan->nama
        ]);
    }

    public function edit($id)
    {
        $karyawan = Karyawan::find($id);
        $jabatan = Jabatan::get();

        return response()->json([
            'id' => $karyawan->id,
            'nama_lengkap' => $karyawan->nama_lengkap,
            'nama_panggilan' => $karyawan->nama_panggilan,
            'email' => $karyawan->email,
            'telepon' => $karyawan->telepon,
            'alamat' => $karyawan->alamat,
            'jabatan_id' => $karyawan->jabatan_id,
            'jabatans' => $jabatan
        ]);
    }

    public function update(Request $request)
    {
        $karyawan = Karyawan::find($request->id);
        $karyawan->nama_lengkap = $request->nama_lengkap;
        $karyawan->nama_panggilan = $request->nama_panggilan;
        $karyawan->email = $request->email;
        $karyawan->telepon = $request->telepon;
        $karyawan->alamat = $request->alamat;
        $karyawan->gender = $request->gender;
        $karyawan->jabatan_id = $request->jabatan_id;
        $karyawan->save();

        $jabatan = Jabatan::find($karyawan->jabatan_id);

        return response()->json([
            'status' => 'Data berhasil diperbaharui',
            'id' => $request->id,
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'jabatan' => $jabatan->name
        ]);
    }

    public function deleteBtn($id)
    {
        $karyawan = Karyawan::find($id);

        return response()->json([
            'id' => $karyawan->id,
            'nama_lengkap' => $karyawan->nama_lengkap
        ]);
    }

    public function delete(Request $request)
    {
        $karyawan = Karyawan::find($request->id);
        $karyawan->delete();

        return response()->json([
            'status' => 'Data berhasil dihapus'
        ]);
    }

    public function status(Request $request)
    {
        $karyawan =  Karyawan::find($request->id);
        $karyawan->status = $request->status;
        $karyawan->save();

        return response()->json([
            'status' => 'true',
            'id' => $karyawan->id,
            'title' => $karyawan->status
        ]);
    }
}
