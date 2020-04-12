<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

//Route::get('/', function () {
//    return view('login');
//});

Route::get('/', 'HomeController@index')->name('default');
Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
    // --- ini master data ---
    Route::prefix('kategori')->group(function () {
        Route::get('', 'KategoriBarangController@index')->name('kategori.index');
        Route::get('new', 'KategoriBarangController@create')->name('kategori.add');
        Route::get('detail/{id?}', 'KategoriBarangController@show')->name('kategori.detail');
        Route::post('save', 'KategoriBarangController@store')->name('kategori.save');
        Route::post('update', 'KategoriBarangController@update')->name('kategori.update');
        Route::get('confrm/{id?}', 'KategoriBarangController@confirm')->name('kategori.confirm');
        Route::post('delete', 'KategoriBarangController@delete')->name('kategori.delete');
    });

    Route::prefix('satuan')->group(function () {
        Route::get('', 'SatuanController@index')->name('satuan.index');
        Route::get('new', 'SatuanController@create')->name('satuan.add');
        Route::get('detail/{id?}', 'SatuanController@show')->name('satuan.detail');
        Route::post('save', 'SatuanController@store')->name('satuan.save');
        Route::post('update', 'SatuanController@update')->name('satuan.update');
        Route::get('confrm/{id?}', 'SatuanController@confirm')->name('satuan.confirm');
        Route::post('delete', 'SatuanController@delete')->name('satuan.delete');
    });

    Route::prefix('brand')->group(function () {
        Route::get('', 'BrandController@index')->name('brand.index');
        Route::get('new', 'BrandController@create')->name('brand.add');
        Route::get('detail/{id?}', 'BrandController@show')->name('brand.detail');
        Route::post('save', 'BrandController@store')->name('brand.save');
        Route::post('update', 'BrandController@update')->name('brand.update');
        Route::get('confrm/{id?}', 'BrandController@confirm')->name('brand.confirm');
        Route::post('delete', 'BrandController@delete')->name('brand.delete');
    });

    Route::prefix('relasi')->group(function () {
        Route::get('', 'RelasiController@index')->name('relasi.index');
        Route::get('new', 'RelasiController@create')->name('relasi.add');
        Route::get('detail/{id?}', 'RelasiController@show')->name('relasi.detail');
        Route::post('save', 'RelasiController@store')->name('relasi.save');
        Route::post('update', 'RelasiController@update')->name('relasi.update');
        Route::get('confrm/{id?}', 'RelasiController@confirm')->name('relasi.confirm');
        Route::post('delete', 'RelasiController@delete')->name('relasi.delete');

        Route::prefix('api')->group(function () {
            Route::get('search', 'RelasiController@apiCustomerSearch')->name('relasi.api.search');
        });
    });

    Route::prefix('barang')->group(function () {
        Route::get('', 'BarangController@index')->name('barang.index');
        Route::get('new', 'BarangController@create')->name('barang.add');
        Route::get('detail/{id?}', 'BarangController@show')->name('barang.detail');
        Route::post('save', 'BarangController@store')->name('barang.save');
        Route::post('update', 'BarangController@update')->name('barang.update');
        Route::get('confrm/{id?}', 'BarangController@confirm')->name('barang.confirm');
        Route::post('delete', 'BarangController@delete')->name('barang.delete');
        Route::get('detail/supplier/{idbarang?}', 'BarangController@supplier_price')->name('barang.detail.supplier');
        Route::get('detail/supplier/{idbarang?}/add', 'BarangController@supplier_price_add')->name('barang.detail.supplier.add');
        Route::post('detail/supplier/{idbarang?}/save', 'BarangController@supplier_price_save')->name('barang.detail.supplier.save');
    });

    Route::prefix('lokasi')->group(function () {
        Route::get('', 'LokasiController@index')->name('lokasi.index');
        Route::get('new', 'LokasiController@create')->name('lokasi.add');
        Route::get('detail/{id?}', 'LokasiController@show')->name('lokasi.detail');
        Route::post('save', 'LokasiController@store')->name('lokasi.save');
        Route::post('update', 'LokasiController@update')->name('lokasi.update');
        Route::get('confrm/{id?}', 'LokasiController@confirm')->name('lokasi.confirm');
        Route::post('delete', 'LokasiController@delete')->name('lokasi.delete');
    });

    /* -------- transaksi pembelian ---------- */
    Route::prefix('pembelian')->group(function () {
        Route::get('', 'PembelianController@index')->name('beli.index');
        Route::get('arsip', 'PembelianController@arsip')->name('beli.arsip');
        Route::post('', 'PembelianController@save')->name('beli.save');
        Route::get('itemsearch', 'PembelianController@search_item')->name('beli.searchitem');
        Route::post('detail/delete', 'PembelianController@delete_detail')->name('beli.detail.delete');

        Route::get('serialnumber', 'PembelianController@serialnumber')->name('beli.serialnumber');
        Route::get('serialnumber/show/{id}', 'PembelianController@serialnumbershow')->name('beli.serialnumber.show');
        Route::post('serialnumber/update/{id}', 'PembelianController@serialnumberupdate')->name('beli.serialnumber.update');
        Route::post('serialnumber/delete', 'PembelianController@serialnumberdelete')->name('beli.serialnumber.delete');
        Route::post('serialnumber/save', 'PembelianController@saveserialnumber')->name('beli.serialnumber.save');
        Route::get('serialnumber/detail', 'PembelianController@detail_serialnumber')->name('beli.serialnumber.detail');

        Route::get('pdf', 'PembelianPDFController@pdf')->name('beli.pdf');
        Route::get('raw', 'PembelianPDFController@raw')->name('beli.raw');
    });

    /* -------- transaksi penjualan ---------- */
    Route::prefix('penjualan')->group(function () {
        Route::get('', 'PenjualanController@index')->name('jual.index');
        Route::get('location', 'PenjualanController@switchLocation')->name('jual.open.sesi.location');
        Route::get('opening', 'PenjualanController@opensesi')->name('jual.open.sesi');
        Route::post('opening/save', 'PenjualanController@opensesisave')->name('jual.open.sesi.save');
    });

});