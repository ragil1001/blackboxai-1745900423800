<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthPegawaiController extends Controller
{
    public function login(Request $request)
{
    // Validasi input
    $validator = Validator::make($request->all(), [
        'EMAIL' => 'required|email',
        'PASSWORD' => 'required|string|min:6',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    // Cek Pegawai aktif
    $pegawai = Pegawai::where('EMAIL', $request->EMAIL)->where('STATUS', 'active')->first();

    if (!$pegawai || !Hash::check($request->PASSWORD, $pegawai->PASSWORD)) {
        return response()->json(['error' => 'Email atau Password salah'], 401);
    }

    // Generate Token
    $token = JWTAuth::fromUser($pegawai);

    return response()->json([
        'token' => $token,
        'pegawai' => [
            'id' => $pegawai->ID_PEGAWAI,
            'nama' => $pegawai->NAMA,
            'email' => $pegawai->EMAIL,
            'role' => $pegawai->getRoleNames(), // Mengambil role pegawai
        ]
    ]);
}


    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['message' => 'Logout berhasil']);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Gagal logout, token tidak valid'], 500);
        }
    }

    public function profile()
    {
        $pegawai = auth()->user();
        return response()->json([
            'pegawai' => [
                'id' => $pegawai->ID_PEGAWAI,
                'nama' => $pegawai->NAMA,
                'email' => $pegawai->EMAIL,
                'role' => $pegawai->getRoleNames(),
            ]
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'ID_JABATAN' => 'required|integer|exists:jabatans,ID_JABATAN',
            'NAMA' => 'required|string|max:50',
            'TELEPON' => 'nullable|string|max:20',
            'ALAMAT' => 'nullable|string|max:250',
            'TGL_LAHIR' => 'nullable|date',
            'EMAIL' => 'required|string|max:50|email|unique:pegawais,EMAIL',
            'PASSWORD' => 'required|string|min:6',
        ]);

        // Check jabatan existence
        $jabatan = \App\Models\Jabatan::find($request->ID_JABATAN);
        if (!$jabatan) {
            return response()->json(['error' => 'Jabatan tidak ditemukan'], 404);
        }

        $pegawai = new Pegawai();
        $pegawai->ID_PEGAWAI = Pegawai::generateIdPegawai();
        $pegawai->ID_JABATAN = $request->ID_JABATAN;
        $pegawai->NAMA = $request->NAMA;
        $pegawai->TELEPON = $request->TELEPON;
        $pegawai->ALAMAT = $request->ALAMAT;
        $pegawai->TGL_LAHIR = $request->TGL_LAHIR;
        $pegawai->EMAIL = $request->EMAIL;
        $pegawai->PASSWORD = bcrypt($request->PASSWORD);
        $pegawai->STATUS = 'active';
        $pegawai->save();

        // Assign role based on jabatan
        $pegawai->assignRoleByJabatan();

        return response()->json(['message' => 'Registrasi berhasil!'], 201);
    }

}
