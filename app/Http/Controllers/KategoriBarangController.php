<?php

namespace App\Http\Controllers;

use App\KategoriBarang;
use Illuminate\Http\Request;

class KategoriBarangController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');
        $kategories = KategoriBarang::where('name', 'like', '%' . $q . '%' )->paginate(10);
        $kategories->appends($request->only('q'));
        return view('app.master.kategori.kategori', ['kategories'=>$kategories]);
    }

    public function create()
    {
        return view('app.master.kategori.kategori-add');
    }

    public function store(Request $request)
    {
        $kategori = new KategoriBarang;
        $kategori->code = $request->input('code');
        $kategori->name = $request->input('name');
        $kategori->save();

        return redirect()->route('kategori.detail', [$kategori])->with('status', 'success')->with('msg', 'Data telah disimpan!');
    }

    public function show($id = ''){
        $kategori = KategoriBarang::find($id);
        return view('app.master.kategori.kategori-edit', ['kategori'=>$kategori]);
    }

    public function update(Request $request){
        $kategori = KategoriBarang::find($request->input('id'));
        $kategori->code = $request->input('code');
        $kategori->name = $request->input('name');
        $kategori->update();
        return redirect()->route('kategori.detail', [$kategori])->with('status', 'success')->with('msg', 'Data telah diperbaharui!');
    }

    public function confirm($id = ''){
        $kategori = KategoriBarang::find($id);
        return view('app.master.kategori.kategori-confirm-delete', ['kategori'=>$kategori]);
    }

    public function delete(Request $request){
        $kategori = KategoriBarang::find($request->input('id'));
        $kategori->delete();
        return redirect()->route('kategori.index')->with('status', 'success')->with('msg', 'Data telah dihapus!');
    }
}
