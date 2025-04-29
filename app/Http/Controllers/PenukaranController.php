<?php

namespace App\Http\Controllers;

use App\Models\Penukaran;
use Illuminate\Http\Request;

class PenukaranController extends Controller
{
    public function index()
    {
        return Penukaran::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'ID_PEMBELI' => 'required|integer',
            'ID_MERCHANDISE' => 'required|integer',
            'ID_PEGAWAI' => 'required|string|max:10',
            'POIN_DIGUNAKAN' => 'nullable|integer',
            'KODE_PENUKARAN' => 'nullable|integer',
            'TANGGAL_PENUKARAN' => 'nullable|date',
            'TANGGAL_DIKLAIM' => 'nullable|date',
        ]);

        return Penukaran::create($request->all());
    }

    public function show($id)
    {
        return Penukaran::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $penukaran = Penukaran::findOrFail($id);
        $penukaran->update($request->all());
        return $penukaran;
    }

    public function destroy($id)
    {
        Penukaran::destroy($id);
        return response()->noContent();
    }
}
