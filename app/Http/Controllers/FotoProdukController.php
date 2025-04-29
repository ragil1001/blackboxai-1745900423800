<?php

namespace App\Http\Controllers;

use App\Models\FotoProduk;
use Illuminate\Http\Request;

class FotoProdukController extends Controller
{
    public function index()
    {
        return FotoProduk::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'KODE_PRODUK' => 'required|string|max:10',
            'URL_FOTO' => 'required|string|max:100',
            'IS_UTAMA' => 'required|boolean',
        ]);

        return FotoProduk::create($request->all());
    }

    public function show($id)
    {
        return FotoProduk::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $fotoProduk = FotoProduk::findOrFail($id);
        $fotoProduk->update($request->all());
        return $fotoProduk;
    }

    public function destroy($id)
    {
        FotoProduk::destroy($id);
        return response()->noContent();
    }
}