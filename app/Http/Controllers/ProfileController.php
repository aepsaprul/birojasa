<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::find(Auth::user()->karyawan_id);
        if ($karyawan != null) {
            return view('pages.profile.index', ['karyawan' => $karyawan]);
        } else {
            return view('error_500');
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|max:30',
            'nama_panggilan' => 'required|max:15',
            'telepon' => 'required|max:15',
            'email' => 'required|email|max:50',
            'gender' => 'required|max:1',
            'alamat' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {
            $karyawan = Karyawan::find($request->id);
            $karyawan->nama_lengkap = $request->nama_lengkap;
            $karyawan->nama_panggilan = $request->nama_panggilan;
            $karyawan->telepon = $request->telepon;
            $karyawan->email = $request->email;
            $karyawan->gender = $request->gender;
            $karyawan->alamat = $request->alamat;
            $karyawan->save();

            $user = User::where('karyawan_id', $request->id)->first();
            $user->name = $request->nama_lengkap;
            $user->email = $request->email;
            $user->save();

            return response()->json([
                'status' => 200,
                'message' => "Data berhasil diperbaharui"
            ]);
        }
    }
}
