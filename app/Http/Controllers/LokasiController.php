<?php

namespace App\Http\Controllers;

use App\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function index(Request $request){
        $q = $request->query('q');
        $list = Lokasi::where('name', 'like', '%' . $q . '%' )->paginate(10);
        $list->appends($request->only('q'));
        return view('app.master.lokasi.lokasi', ['list'=>$list]);
    }

    public function create(){
        return view('app.master.lokasi.lokasi-add');
    }

    public function store(Request $request){
        $lokasi = new Lokasi;
        $lokasi->code = $request->input('code');
        $lokasi->name = $request->input('name');
        $lokasi->address = $request->input('address');
        $lokasi->phone = $request->input('phone');
        $lokasi->pic = $request->input('pic');
        $lokasi->save();
        return redirect()->route('lokasi.detail', [$lokasi])->with('status', 'success')->with('msg', 'Data telah disimpan!');
    }

    public function show($id = ''){
        $lokasi = Lokasi::find($id);
        return view('app.master.lokasi.lokasi-edit', ['lokasi'=>$lokasi]);
    }

    public function update(Request $request){
        $lokasi = Lokasi::find($request->input('id'));
        $lokasi->code = $request->input('code');
        $lokasi->name = $request->input('name');
        $lokasi->address = $request->input('address');
        $lokasi->phone = $request->input('phone');
        $lokasi->pic = $request->input('pic');
        $lokasi->update();
        return redirect()->route('lokasi.detail', [$lokasi])->with('status', 'success')->with('msg', 'Data telah diperbaharui!');
    }

    public function confirm($id = ''){
        $lokasi = Lokasi::find($id);
        return view('app.master.lokasi.lokasi-confirm-delete', ['lokasi'=>$lokasi]);
    }

    public function delete(Request $request){
        $lokasi = Lokasi::find($request->input('id'));
        $lokasi->delete();
        return redirect()->route('lokasi.index')->with('status', 'success')->with('msg', 'Data telah dihapus!');
    }
}
