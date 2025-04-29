<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use Illuminate\Http\Request;

class PembeliController extends Controller
{
    public function index()
    {
        return Pembeli::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'NAMA' => 'required|string|max:50',
            'TELEPON' => 'nullable|string|max:20',
            'POIN_LOYALITAS' => 'nullable|integer',
            'EMAIL' => 'nullable|string|max:50',
            'PASSWORD' => 'nullable|string|max:50',
            'STATUS' => 'nullable|in:active,inactive',
        ]);

        return Pembeli::create($request->all());
    }

    public function show($id)
    {
        return Pembeli::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $pembeli = Pembeli::findOrFail($id);
        $pembeli->update($request->all());
        return $pembeli;
    }

    public function destroy($id)
    {
        Pembeli::destroy($id);
        return response()->noContent();
    }
}