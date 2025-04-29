<?php

namespace App\Http\Controllers;

use App\Models\Penitip;
use Illuminate\Http\Request;

class PenitipController extends Controller
{
    public function index()
    {
        return Penitip::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'ID_PEGAWAI' => 'required|string|max:10',
            'NAMA' => 'required|string|max:50',
            'ALAMAT' => 'nullable|string|max:250',
            'TELEPON' => 'nullable|string|max:20',
            'SALDO' => 'nullable|numeric',
            'POIN_LOYALITAS' => 'nullable|integer',
            'RATING' => 'nullable|numeric',
            'BADGE' => 'nullable|boolean',
            'NO_KTP' => 'nullable|string|max:20',
            'EMAIL' => 'nullable|string|max:50',
            'PASSWORD' => 'nullable|string|max:50',
            'STATUS' => 'nullable|in:active,inactive',
            'JLH_PENJUALAN' => 'nullable|integer',
            'FOTO_KTP' => 'nullable|string|max:100',
        ]);

        // Generate ID_PENITIP
        $request['ID_PENITIP'] = Penitip::generateIdPenitip();

        return Penitip::create($request->all());
    }

    public function show($id)
    {
        return Penitip::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $penitip = Penitip::findOrFail($id);
        $penitip->update($request->all());
        return $penitip;
    }

    public function destroy($id)
    {
        Penitip::destroy($id);
        return response()->noContent();
    }
}