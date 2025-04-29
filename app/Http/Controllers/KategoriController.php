<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        return Kategori::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'NAMA' => 'required|string|max:50',
        ]);

        return Kategori::create($request->all());
    }

    public function show($id)
    {
        return Kategori::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->all());
        return $kategori;
    }

    public function destroy($id)
    {
        Kategori::destroy($id);
        return response()->noContent();
    }
}