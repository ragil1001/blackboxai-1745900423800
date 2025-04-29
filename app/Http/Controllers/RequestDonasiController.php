<?php

namespace App\Http\Controllers;

use App\Models\RequestDonasi;
use Illuminate\Http\Request;

class RequestDonasiController extends Controller
{
    public function index()
    {
        return RequestDonasi::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'ID_ORGANISASI' => 'required|string|max:10',
            'ID_PEGAWAI' => 'required|string|max:10',
            'DESKRIPSI_PERMINTAAN ' => 'nullable|string',
            'TANGGAL_PERMINTAAN' => 'nullable|date',
            'STATUS' => 'nullable|string|max:20',
        ]);

        return RequestDonasi::create($request->all());
    }

    public function show($id)
    {
        return RequestDonasi::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $requestDonasi = RequestDonasi::findOrFail($id);
        $requestDonasi->update($request->all());
        return $requestDonasi;
    }

    public function destroy($id)
    {
        RequestDonasi::destroy($id);
        return response()->noContent();
    }
}