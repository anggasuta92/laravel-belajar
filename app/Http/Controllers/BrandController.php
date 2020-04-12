<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(Request $request){
        $q = $request->query('q');
        $brands = Brand::where('name', 'like', '%' . $q . '%' )->paginate(10);
        $brands->appends($request->only('q'));
        return view('app.master.brand.brand', ['brands'=>$brands]);
    }

    public function create(){
        return view('app.master.brand.brand-add');
    }

    public function store(Request $request){
        $brand = new Brand;
        $brand->name = $request->input('name');
        $brand->save();

        return redirect()->route('brand.detail', [$brand])->with('status', 'success')->with('msg', 'Data telah disimpan!');
    }

    public function show($id = ''){
        $brand = Brand::find($id);
        return view('app.master.brand.brand-edit', ['brand'=>$brand]);
    }

    public function update(Request $request){
        $brand = Brand::find($request->input('id'));
        $brand->name = $request->input('name');
        $brand->update();
        return redirect()->route('brand.detail', [$brand])->with('status', 'success')->with('msg', 'Data telah diperbaharui!');
    }

    public function confirm($id = ''){
        $brand = Brand::find($id);
        return view('app.master.brand.brand-confirm-delete', ['brand'=>$brand]);
    }

    public function delete(Request $request){
        $brand = Brand::find($request->input('id'));
        $brand->delete();
        return redirect()->route('brand.index')->with('status', 'success')->with('msg', 'Data telah dihapus!');
    }
}
