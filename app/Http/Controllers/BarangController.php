<?php

namespace App\Http\Controllers;

use App\Barang;
use App\KategoriBarang;
use App\Satuan;
use App\Brand;
use App\HargaBeli;
use App\Relasi;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request){
        $q = $request->query('q');
        $barangs = Barang::where('name', 'like', '%' . $q . '%' )
            ->orWhere('code', 'like', '%' . $q . '%' )
            ->orWhere('barcode', 'like', '%' . $q . '%' )
            ->paginate(10);
        $barangs->appends($request->only('q'));
        return view('app.master.barang.barang', ['barangs'=>$barangs]);
    }

    public function create(){
        $kategories = KategoriBarang::all();
        $satuans = Satuan::all();
        $brands = Brand::all();
        return view('app.master.barang.barang-add', ['kategories'=>$kategories, 'satuans'=>$satuans, 'brands'=>$brands]);
    }

    public function store(Request $request){
        /* --------------------- create auto code --------------------- */
        $kategoriBarangId = $request->input('kategori_id');
        $counter = Barang::where('kategori_id', $kategoriBarangId)->max('counter') + 1;
        $kategori = KategoriBarang::find($kategoriBarangId);
        $code = $kategori->code . "" . sprintf("%05s", abs($counter));
        /* --------------------- create auto code --------------------- */

        $barang = new Barang;
        $barang->code = $code;
        $barang->counter = $counter;
        $barang->barcode = $request->input('barcode');
        $barang->name = $request->input('name');
        $barang->kategori_id = $request->input('kategori_id');
        $barang->satuan_id = $request->input('satuan_id');
        $barang->merk_id = $request->input('merk_id');
        $barang->hpp = $request->input('hpp');
        $barang->harga_jual = $request->input('harga_jual');
        $barang->use_sn = $request->input('use_sn');
        $barang->save();

        return redirect()->route('barang.detail', [$barang])
            ->with('status', 'success')
            ->with('msg', 'Data telah disimpan!');
    }

    public function show($id = ''){
        $kategories = KategoriBarang::all();
        $satuans = Satuan::all();
        $brands = Brand::all();
        $barang = Barang::find($id);
        return view('app.master.barang.barang-edit', ['barang'=>$barang, 'kategories'=>$kategories, 'satuans'=>$satuans, 'brands'=>$brands]);
    }

    public function update(Request $request){
        $barang = Barang::find($request->input('id'));
        $barang->barcode = $request->input('barcode');
        $barang->name = $request->input('name');
        $barang->kategori_id = $request->input('kategori_id');
        $barang->satuan_id = $request->input('satuan_id');
        $barang->merk_id = $request->input('merk_id');
        $barang->hpp = $request->input('hpp');
        $barang->harga_jual = $request->input('harga_jual');
        $barang->use_sn = $request->input('use_sn');
        $barang->update();

        return redirect()->route('barang.detail', [$barang])
            ->with('status', 'success')
            ->with('msg', 'Data telah diperbaharui!');
    }

    public function confirm($id = ''){
        $barang = Barang::find($id);
        return view('app.master.barang.barang-confirm-delete', ['barang'=>$barang]);
    }

    public function delete(Request $request){
        $barang = Barang::find($request->input('id'));
        $barang->delete();
        return redirect()->route('barang.index')
            ->with('status', 'success')
            ->with('msg', 'Data telah dihapus!');
    }

    public function supplier_price($idbarang = ''){
        $barang = Barang::find($idbarang);
        $harga_beli = HargaBeli::where('barang_id', $barang->id )->get();
        return view('app.master.barang.barang-supplier-price', ['barang'=>$barang, 'list_harga'=>$harga_beli]);
    }

    public function supplier_price_add($idbarang = ''){
        $barang = Barang::find($idbarang);
        $relasi = Relasi::where('type', 0)->get();
        return view('app.master.barang.barang-supplier-price-insert', ['barang'=>$barang, 'relasies'=>$relasi]);
    }

    public function supplier_price_save(Request $request, $idbarang = ''){
        $barang = Barang::find($idbarang);
        $harga_beli = new HargaBeli();
        $harga_beli->barang_id = $barang->id;
        $harga_beli->relasi_id = $request->input('relasi_id');
        $harga_beli->harga_beli = $request->input('harga_beli');
        $harga_beli->save();

        return redirect()->route('barang.detail.supplier', ['idbarang'=>$barang->id])
            ->with('status', 'success')
            ->with('msg', 'Data telah disimpan!');
    }

}

