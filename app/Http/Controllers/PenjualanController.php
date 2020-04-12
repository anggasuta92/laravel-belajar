<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SesiPenjualan;
use App\Shift;
use App\Lokasi;

class PenjualanController extends Controller
{
    function index(Request $request){
        $locations = Lokasi::all();
        return view('app.transaksi.penjualan.penjualan', ['locations'=>$locations]);
    }

    function switchLocation(Request $request){
        $locations = Lokasi::all();
        return view('app.transaksi.penjualan.switch-location', ['locations'=>$locations]);
    }

    function opensesi(Request $request){
        $shifts = Shift::all();
        return view('app.transaksi.penjualan.open-sesi', ['shifts'=>$shifts]);
    }

    /* cek sesi kasir open apa close */
    function checkOpeningKasir($date, $user_id){
        $sesi = SesiPenjualan::where('','')->get();
        return 0;
    }
}
