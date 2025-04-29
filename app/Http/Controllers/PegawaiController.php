<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'ID_JABATAN' => 'required|integer',
        'NAMA' => 'required|string|max:50',
        'TELEPON' => 'nullable|string|max:20',
        'ALAMAT' => 'nullable|string|max:250',
        'TGL_LAHIR' => 'nullable|date',
        'EMAIL' => 'nullable|string|max:50|email',
        'PASSWORD' => 'nullable|string|max:50',
        'STATUS' => 'nullable|in:active,inactive',
    ]);

    // Cek apakah jabatan ada
    $jabatan = Jabatan::find($request->ID_JABATAN);
    if (!$jabatan) {
        return response()->json(['error' => 'Jabatan tidak ditemukan'], 404);
    }

    // Generate ID_PEGAWAI
    $request['ID_PEGAWAI'] = Pegawai::generateIdPegawai();

    // Encrypt password jika ada
    if ($request->has('PASSWORD')) {
        $request['PASSWORD'] = bcrypt($request->PASSWORD);
    }

    // Simpan pegawai baru
    $pegawai = Pegawai::create($request->all());

    // Assign role berdasarkan jabatan
    // Pastikan jabatan yang dimiliki pegawai memiliki role yang valid
    try {
        $pegawai->assignRoleByJabatan();
    } catch (\Exception $e) {
        return response()->json(['error' => 'Role assignment failed: ' . $e->getMessage()], 500);
    }

    return response()->json($pegawai, 201);
}


    public function index()
    {
        return Pegawai::all();
    }

    public function show($id)
    {
        return Pegawai::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->update($request->all());
        return $pegawai;
    }

    public function destroy($id)
    {
        Pegawai::destroy($id);
        return response()->noContent();
    }
}
