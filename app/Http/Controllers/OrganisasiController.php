<?php

namespace App\Http\Controllers;

use App\Models\Organisasi;
use Illuminate\Http\Request;

class OrganisasiController extends Controller
{
    public function index()
    {
        return Organisasi::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'NAMA' => 'required|string|max:50',
            'ALAMAT' => 'nullable|string|max:50',
            'TELEPON' => 'nullable|string|max:20',
            'DESKRIPSI' => 'nullable|string|max:250',
            'EMAIL' => 'nullable|string|max:50',
            'PASSWORD' => 'nullable|string|max:50',
            'STATUS' => 'nullable|in:active,inactive',
            'FOTO_ORGANISASI' => 'nullable|string|max:250',
        ]);

        $request['ID_ORGANISASI'] = Organisasi::generateIdOrganisasi();

        return Organisasi::create($request->all());
    }

    public function show($id)
    {
        return Organisasi::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $organisasi = Organisasi::findOrFail($id);
        $organisasi->update($request->all());
        return $organisasi;
    }

    public function destroy($id)
    {
        Organisasi::destroy($id);
        return response()->noContent();
    }
}