<?php

namespace App\Http\Controllers;

use App\Models\Subkategori;
use Illuminate\Http\Request;

class SubkategoriController extends Controller
{
    public function index()
    {
        return Subkategori::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'ID_KATEGORI' => 'required|integer',
            'NAMASUB' => 'nullable|string|max:70',
        ]);

        return Subkategori::create($request->all());
    }

    public function show($id)
    {
        return Subkategori::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $subkategori = Subkategori::findOrFail($id);
        $subkategori->update($request->all());
        return $subkategori;
    }

    public function destroy($id)
    {
        Subkategori::destroy($id);
        return response()->noContent();
    }
}