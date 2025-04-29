<?php

namespace App\Http\Controllers;

use App\Models\Komisi;
use Illuminate\Http\Request;

class KomisiController extends Controller
{
    public function index()
    {
        return Komisi::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'KODE_PRODUK' => 'required|string|max:10',
            'ID_PEGAWAI' => 'nullable|string|max:10',
            'ID_PENITIP' => 'required|string|max:10',
            'KOMISI_PENITIP' => 'nullable|integer',
            'KOMISI_HUNTER' => 'nullable|integer',
            'KOMISI_REUSEMART' => 'nullable|integer',
            'BONUS' => 'nullable|integer',
        ]);

        return Komisi::create($request->all());
    }

    public function show($kode_produk)
    {
        return Komisi::findOrFail($kode_produk);
    }

    public function update(Request $request, $kode_produk)
    {
        $komisi = Komisi::findOrFail($kode_produk);
        $komisi->update($request->all());
        return $komisi;
    }

    public function destroy($kode_produk)
    {
        Komisi::destroy($kode_produk);
        return response()->noContent();
    }
}