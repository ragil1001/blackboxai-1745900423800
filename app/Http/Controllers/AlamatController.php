<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use Illuminate\Http\Request;

class AlamatController extends Controller
{
    public function index()
    {
        return Alamat::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'ID_PEMBELI' => 'required|integer',
            'JALAN' => 'nullable|string|max:50',
            'KECAMATAN' => 'nullable|string|max:50',
            'KOTA' => 'nullable|string|max:50',
            'KODE_POS' => 'nullable|string|max:50',
            'ALAMAT_UTAMA' => 'nullable|boolean',
        ]);

        return Alamat::create($request->all());
    }

    public function show($id)
    {
        return Alamat::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $alamat = Alamat::findOrFail($id);
        $alamat->update($request->all());
        return $alamat;
    }

    public function destroy($id)
    {
        Alamat::destroy($id);
        return response()->noContent();
    }
}