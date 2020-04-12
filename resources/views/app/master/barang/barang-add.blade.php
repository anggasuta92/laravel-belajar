@extends('layouts.main')

@section('content')
    <div class="col-md-10">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><span class="glyphicon glyphicon-folder-open"></span> <i>Tambah Barang</i></h3>
            </div>

            <form action="{{ route('barang.save') }}" method="post" role="form">
                <div class="box-body">
                    @csrf
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="code">Kode</label>
                            <input type="text" class="form-control" id="code" maxlength="5" name="code" placeholder="(Automatis)" disabled>
                        </div>
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama barang" required>
                        </div>
                        <div class="form-group">
                            <label for="kategori_id">Kategori Barang</label>
                            <select class="form-control" name="kategori_id">
                                @foreach($kategories as $key => $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="satuan_id">Satuan Barang</label>
                            <select class="form-control" name="satuan_id">
                                @foreach($satuans as $key => $satuan)
                                <option value="{{ $satuan->id }}">{{ $satuan->code }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="satuan_id">Brand / Merk</label>
                            <select class="form-control" name="merk_id">
                                @foreach($brands as $key => $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="barcode">Barcode</label>
                            <input type="text" class="form-control" id="barcode" maxlength="5" name="barcode" placeholder="Masukkan barcode barang" required>
                        </div>
                        <div class="form-group">
                            <label for="use_sn">Menggunakan SN / IMEI ?</label>
                            <select class="form-control" name="use_sn">
                                <option value="0" >Tidak</option>
                                <option value="1" >Ya</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="hpp">HPP</label>
                            <input type="number" class="form-control" id="hpp" name="hpp" placeholder="Masukkan harga pokok penjualan barang">
                        </div>
                        <div class="form-group">
                            <label for="harga_jual">Harga Jual</label>
                            <input type="number" class="form-control" id="harga_jual" name="harga_jual" placeholder="Masukkan harga jual">
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="box-tools">
                        <div class="pull-right">
                            <a href="{{ route('barang.index') }}" class="btn btn-sm btn-warning">Kembali</a>
                        </div>
                        <div class="pull-left">
                            <input type="submit" class="btn btn-sm btn-primary" value="Simpan Data">
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection