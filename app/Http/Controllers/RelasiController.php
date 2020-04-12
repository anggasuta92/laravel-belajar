<?php

namespace App\Http\Controllers;

use App\Relasi;
use Illuminate\Http\Request;

class RelasiController extends Controller
{
    public function index(Request $request){
        $q = $request->query('q');
        $relations = Relasi::where('name', 'like', '%' . $q . '%' )->orWhere('code', 'like', '%' . $q . '%' )->paginate(10);
        $relations->appends($request->only('q'));
        return view('app.master.relasi.relasi', ['relations'=>$relations]);
    }

    public function create(){
        return view('app.master.relasi.relasi-add');
    }

    public function store(Request $request){
        $relasi = new Relasi;
        /* --------------------- create auto code --------------------- */
        $typeRelasi = $request->input('type');
        $counter = Relasi::where('type', $typeRelasi)->max('counter') + 1;
        $code = "";
        if($typeRelasi==0){
            $code = "S" . "" . sprintf("%010s", abs($counter));
        }else if($typeRelasi==1){
            $code = "C" . "" . sprintf("%010s", abs($counter));
        }
        /* --------------------- create auto code --------------------- */

        $relasi->code = $code;
        $relasi->counter = $counter;
        $relasi->name = $request->input('name');
        $relasi->id_card_number = $request->input('id_card_number');
        $relasi->tax_id_number = $request->input('tax_id_number');
        $relasi->address = $request->input('address');
        $relasi->phone = $request->input('phone');
        $relasi->email = $request->input('email');
        $relasi->website = $request->input('website');
        $relasi->ar_limit = $request->input('ar_limit');
        $relasi->ap_limit = $request->input('ap_limit');
        $relasi->type = $typeRelasi;
        $relasi->save();

        return redirect()->route('relasi.detail', [$relasi])->with('status', 'success')->with('msg', 'Data telah disimpan!');
    }

    public function show($id = ''){
        $relasi = Relasi::find($id);
        return view('app.master.relasi.relasi-edit', ['relasi'=>$relasi]);
    }

    public function update(Request $request){
        $relasi = Relasi::find($request->input('id'));
        
        $relasi->name = $request->input('name');
        $relasi->id_card_number = $request->input('id_card_number');
        $relasi->tax_id_number = $request->input('tax_id_number');
        $relasi->address = $request->input('address');
        $relasi->phone = $request->input('phone');
        $relasi->email = $request->input('email');
        $relasi->website = $request->input('website');
        $relasi->ar_limit = $request->input('ar_limit');
        $relasi->type = $request->input('type');
        $relasi->update();
        return redirect()->route('relasi.detail', [$relasi])->with('status', 'success')->with('msg', 'Data telah diperbaharui!');
    }

    public function confirm($id = ''){
        $relasi = Relasi::find($id);
        return view('app.master.relasi.relasi-confirm-delete', ['relasi'=>$relasi]);
    }

    public function delete(Request $request){
        $relasi = Relasi::find($request->input('id'));
        $relasi->delete();
        return redirect()->route('relasi.index')->with('status', 'success')->with('msg', 'Data telah dihapus!');
    }

    /* API */
    public function apiCustomerSearch(Request $request){
        $q = $request->query('q');
        return Relasi::where('name', 'like', '%' . $q . '%' )
            ->orWhere('code', 'like', '%' . $q . '%' )->get();
    }
}
