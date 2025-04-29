<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index()
    {
        return Jabatan::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'NAMA' => 'required|string|max:50',
        ]);

        return Jabatan::create($request->all());
    }

    public function show($id)
    {
        return Jabatan::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $jabatan = Jabatan::findOrFail($id);
        $jabatan->update($request->all());
        return $jabatan;
    }

    public function destroy($id)
    {
        Jabatan::destroy($id);
        return response()->noContent();
    }
}