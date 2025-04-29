<?php

namespace App\Http\Controllers;

use App\Models\Diskusi;
use Illuminate\Http\Request;

class DiskusiController extends Controller
{
    public function index()
    {
        // Mengambil semua diskusi beserta balasannya
        return Diskusi::with('balasan')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'ID_BALASANDISKUSI' => 'nullable|integer|exists:diskusis,ID_DISKUSI',
            'ID_PEGAWAI' => 'nullable|string|max:10',
            'ID_PEMBELI' => 'nullable|integer',
            'ID_PENITIP' => 'nullable|string|max:10',
            'KODE_PRODUK' => 'required|string|max:10',
            'PESAN' => 'required|string',
            'TANGGAL_DIBUAT' => 'nullable|date',
        ]);

        return Diskusi::create($request->all());
    }

    public function show($id)
    {
        return Diskusi::with('balasan')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $diskusi = Diskusi::findOrFail($id);
        $diskusi->update($request->all());
        return $diskusi;
    }

    public function destroy($id)
    {
        Diskusi::destroy($id);
        return response()->noContent();
    }
}