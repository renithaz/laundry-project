<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BelajarController extends Controller
{
    public function index()
    {
        return view('belajar');
    }

    public function getSiswa()
    {
        $title = "Data Siswa";
        $siswa = [
            [
                'nama' => 'reni',
                'nilai' => 100,
            ],
            [
                'nama' => 'renit',
                'nilai' => 95,
            ],
            [
                'nama' => 'renith',
                'nilai' => 90,
            ],
        ];
        return view('siswa', compact('title', 'siswa')); //compact utk lempar ke views namanya siswa.blade
    }

    public function create()
    {
        return view('tambah-siswa');
    }
    
    public function store(Request $request){
        $nama = $request->nama;
        $nilai = $request->nilai;

        $status = $nilai >=75 ? 'lulus' : 'tidak lulus';

        return "Siswa $nama dengan nilai $nilai dinyatakan $status";
    }
}
