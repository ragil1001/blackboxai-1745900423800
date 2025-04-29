<?php

namespace App\Http\Controllers;

use App\Models\BarangTitipan;
use Illuminate\Http\Request;

class BarangTitipanController extends Controller
{
    public function index()
    {
        return BarangTitipan::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'ID_SUBKATEGORI' => 'required|integer',
            'ID_PENITIPAN' => 'required|integer',
            'ID_PEGAWAI' => 'nullable|string|max:10',
            'ID_PENJUALAN' => 'nullable|integer',
            'NAMA' => 'required|string|max:50',
            'HARGA_JUAL' => 'nullable|integer',
            'BERAT' => 'nullable|numeric',
            'TANGGAL_KADALUARSA' => 'nullable|date',
            'TANGGAL_PERPANJANGAN' => 'nullable|date',
            'STATUS' => 'nullable|string|max:20',
            'TERJUAL_CEPAT' => 'nullable|boolean',
            'KONDISI' => 'nullable|string|max:20',
            'TANGGAL_GARANSI' => 'nullable|date',
            'rating' => 'nullable|integer|max:5',
            'DESKRIPSI' => 'nullable|string|max:250',
        ]);

        // Generate angka increment
        $increment = BarangTitipan::generateKodeProduk();

        // Ambil huruf depan dari nama produk
        $hurufDepan = strtoupper(substr($request->NAMA, 0, 1));

        // Format KODE_PRODUK
        $request['KODE_PRODUK'] = $hurufDepan . $increment;

        return BarangTitipan::create($request->all());
    }

    public function show($kode_produk)
    {
        return BarangTitipan::findOrFail($kode_produk);
    }

    public function update(Request $request, $kode_produk)
    {
        $barangTitipan = BarangTitipan::findOrFail($kode_produk);
        $barangTitipan->update($request->all());
        return $barangTitipan;
    }

    public function destroy($kode_produk)
    {
        BarangTitipan::destroy($kode_produk);
        return response()->noContent();
    }
}