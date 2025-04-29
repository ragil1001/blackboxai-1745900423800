<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        return Wishlist::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'KODE_PRODUK' => 'required|string|max:10',
            'ID_PEMBELI' => 'required|integer',
        ]);

        return Wishlist::create($request->all());
    }

    public function show($id)
    {
        return Wishlist::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $wishlist = Wishlist::findOrFail($id);
        $wishlist->update($request->all());
        return $wishlist;
    }

    public function destroy($id)
    {
        Wishlist::destroy($id);
        return response()->noContent();
    }
}