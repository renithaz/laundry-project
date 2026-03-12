<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerhitunganController extends Controller
{
    function index(){
        return view('balok.lp_balok');
    }

    function indexKubus(){
        return view('balok2.v_balok');
    }

    function indexTabung() {
        return view('tabung.lp_tabung');
    }
    function store(Request $request){
        $angka1 = $request->angka1;
        $angka2 = $request->angka2;
        $operator = $request->operator;

        $hasil = 0;
        switch ($operator) {
            case '+':
                $hasil = $angka1 + $angka2;
                break;

            case '-':
                $hasil = $angka1 - $angka2;
                break;

            case '*':
                $hasil = $angka1 * $angka2;
                break;

            case '/':
                if ($angka2 == 0){
                    return back()->with('error', 'tidak bisa dibagi 0!');
                }
                $hasil = $angka1 / $angka2;
                break;
        }
        return view('perhitungan.index', compact('hasil'));
    }

    function storeLpKubus(Request $request){
        //L = 6*s^2
        $s = $request->sisi;
        $hasil = 6 * $s * $s;

        return view('balok.lp_balok', compact('hasil'));
    }

    function storeVolumeKubus(Request $request){
        //volume = s^3
        $s = $request->sisi;
        $vol = $s * $s * $s;

        return view('balok2.v_balok', compact('vol'));
    }

    function storeLuasTabung(Request $request){
        //luas
        $r = $request->jari_jari;
        $t = $request->tinggi;
        $phi = 3.14;

        $luasTabung = $phi * $r * $r * $t;

        return view('tabung.lp_tabung', compact('luasTabung'));
    }
}