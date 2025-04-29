<?php

namespace App\Http\Controllers;

use App\Models\Merchandise;
use Illuminate\Http\Request;

class MerchandiseController extends Controller
{
    public function index()
    {
        return Merchandise::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'NAMA' => 'required|string|max:50',
            'DESKRIPSI' => 'nullable|string|max:250',
            'POIN_DIBUTUHKAN' => 'required|integer',
            'STOK' => 'required|integer',
            'URL_GAMBAR' => 'nullable|string|max:50',
        ]);

        return Merchandise::create($request->all());
    }

    public function show($id)
    {
        return Merchandise::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $merchandise = Merchandise::findOrFail($id);
        $merchandise->update($request->all());
        return $merchandise;
    }

    public function destroy($id)
    {
        Merchandise::destroy($id);
        return response()->noContent();
    }
}