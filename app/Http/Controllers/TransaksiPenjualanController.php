<?php

namespace App\Http\Controllers;

use App\Models\TransaksiPenjualan;
use Illuminate\Http\Request;

class TransaksiPenjualanController extends Controller
{
    public function index()
    {
        return TransaksiPenjualan::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'ID_PEMBELI' => 'required|integer',
            'ID_PEGAWAI_GUDANG' => 'required|string|max:10',
            'ID_PEGAWAI_CS' => 'required|string|max:10',
            'ID_PEGAWAI_KURIR' => 'nullable|string|max:10',
            'NO_NOTA_PENJUALAN' => 'nullable|string|max:50',
            'TOTAL_BIAYA' => 'nullable|integer',
            'ONGKIR' => 'nullable|integer',
            'POIN_TERPAKAI' => 'nullable|integer',
            'TOTAL_AKHIR' => 'nullable|integer',
            'POIN_DIPEROLEH' => 'nullable|integer',
            'TANGGAL_PESANAN' => 'nullable|date',
            'TANGGAL_PEMBAYARAN' => 'nullable|date',
            'BUKTI_PEMBAYARAN' => 'nullable|string|max:50',
            'METODE_PENGIRIMAN' => 'nullable|string|max:50',
            'TANGGAL_SIAP' => 'nullable|date',
            'STATUS' => 'nullable|string|max:20',
            'TOTAL_POIN_PEMBELI' => 'nullable|integer',
            'ALAMAT_PENGIRIMAN' => 'nullable|string',
        ]);
        
        $request['NO_NOTA_PENJUALAN'] = TransaksiPenjualan::generateNoNotaPenjualan();

        return TransaksiPenjualan::create($request->all());
    }

    public function show($id)
    {
        return TransaksiPenjualan::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $transaksiPenjualan = TransaksiPenjualan::findOrFail($id);
        $transaksiPenjualan->update($request->all());
        return $transaksiPenjualan;
    }

    public function destroy($id)
    {
        TransaksiPenjualan::destroy($id);
        return response()->noContent();
    }
}