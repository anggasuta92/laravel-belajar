<?php

namespace App\Http\Controllers;

use App\Satuan;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    public function index(Request $request){
        $q = $request->query('q');
        $satuans = Satuan::where('name', 'like', '%' . $q . '%' )->paginate(10);
        $satuans->appends($request->only('q'));
        return view('app.master.satuan.satuan', ['satuans'=>$satuans]);
    }

    public function create(){
        return view('app.master.satuan.satuan-add');
    }

    public function store(Request $request){
        $satuan = new Satuan;
        $satuan->code = $request->input('code');
        $satuan->name = $request->input('name');
        $satuan->save();

        return redirect()->route('satuan.detail', [$satuan])->with('status', 'success')->with('msg', 'Data telah disimpan!');
    }

    public function show($id = ''){
        $satuan = Satuan::find($id);
        return view('app.master.satuan.satuan-edit', ['satuan'=>$satuan]);
    }

    public function update(Request $request){
        $satuan = Satuan::find($request->input('id'));
        $satuan->code = $request->input('code');
        $satuan->name = $request->input('name');
        $satuan->update();
        return redirect()->route('satuan.detail', [$satuan])->with('status', 'success')->with('msg', 'Data telah diperbaharui!');
    }

    public function confirm($id = ''){
        $satuan = Satuan::find($id);
        return view('app.master.satuan.satuan-confirm-delete', ['satuan'=>$satuan]);
    }

    public function delete(Request $request){
        $satuan = Satuan::find($request->input('id'));
        $satuan->delete();
        return redirect()->route('satuan.index')->with('status', 'success')->with('msg', 'Data telah dihapus!');
    }
}
