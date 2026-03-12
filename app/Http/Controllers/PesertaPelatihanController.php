<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PesertaPelatihanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pesertaPelatihan = \App\Models\PesertaPelatihan::orderBy('id', 'DESC')->get();
        return view('peserta_pelatihans.index', compact('pesertaPelatihan'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('peserta_pelatihans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'nik' => 'required|numeric',
            'kartu_keluarga' => 'required|numeric',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'pendidikan_terakhir' => 'required',
            'nama_sekolah' => 'required',
            'jurusan' => 'required',
            'no_hp' => 'required|numeric',
            'email' => 'required|email',
            'aktivitas_saat_ini' => 'required',
        ]);

        \App\Models\PesertaPelatihan::create($request->all());

        return redirect()->route('pesertapelatihan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
