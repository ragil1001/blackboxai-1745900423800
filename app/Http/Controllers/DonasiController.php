<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use Illuminate\Http\Request;

class DonasiController extends Controller
{
    public function index()
    {
        return Donasi::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'KODE_PRODUK' => 'required|string|max:10',
            'ID_REQUEST' => 'required|integer',
            'NAMA_PENERIMA' => 'nullable|string|max:50',
            'TANGGAL_DONASI' => 'nullable|date',
        ]);

        return Donasi::create($request->all());
    }

    public function show($kode_produk, $id_request)
    {
        return Donasi::where('KODE_PRODUK', $kode_produk)->where('ID_REQUEST', $id_request)->firstOrFail();
    }

    public function update(Request $request, $kode_produk, $id_request)
    {
        $donasi = Donasi::where('KODE_PRODUK', $kode_produk)->where('ID_REQUEST', $id_request)->firstOrFail();
        $donasi->update($request->all());
        return $donasi;
    }

    public function destroy($kode_produk, $id_request)
    {
        Donasi::where('KODE_PRODUK', $kode_produk)->where('ID_REQUEST', $id_request)->delete();
        return response()->noContent();
    }
}