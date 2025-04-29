<?php

namespace App\Http\Controllers;

use App\Models\TransaksiPenitipan;
use Illuminate\Http\Request;

class TransaksiPenitipanController extends Controller
{
    public function index()
    {
        return TransaksiPenitipan::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'ID_PENITIP' => 'required|string|max:10',
            'ID_PEGAWAI_HUNTER' => 'nullable|string|max:10',
            'ID_PEGAWAI_QC' => 'required|string|max:10',
            'NO_NOTA_PENITIPAN' => 'nullable|string|max:20',
            'TANGGAL_PENITIPAN' => 'nullable|date',
            'TOTAL_NILAI_BARANG' => 'nullable|integer',
            'CATATAN' => 'nullable|string|max:250',
        ]);

        // Generate NO_NOTA_PENITIPAN
        $request['NO_NOTA_PENITIPAN'] = TransaksiPenitipan::generateNoNotaPenitipan();

        return TransaksiPenitipan::create($request->all());
    }

    public function show($id)
    {
        return TransaksiPenitipan::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $transaksiPenitipan = TransaksiPenitipan::findOrFail($id);
        $transaksiPenitipan->update($request->all());
        return $transaksiPenitipan;
    }

    public function destroy($id)
    {
        TransaksiPenitipan::destroy($id);
        return response()->noContent();
    }
}