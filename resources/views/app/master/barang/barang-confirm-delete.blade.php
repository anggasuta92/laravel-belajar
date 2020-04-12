@extends('layouts.main')

@section('content')
    <div class="col-md-5">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><span class="glyphicon glyphicon-folder-open"></span> <i> Apakah anda yakin akan menghapus data ini? </i></h3>
            </div>

            <form action="{{ route('barang.delete') }}" method="post" role="form">
                <div class="box-body">
                    @csrf
                    <input type="hidden" name="id" value="{{ $barang->id }}">
                    <div class="form-group">
                        <label for="code">Kode</label>
                        <input type="text" class="form-control" id="code" maxlength="5" name="code" value="{{ $barang->code }}" placeholder="" disabled>
                    </div>
                    <div class="form-group">
                        <label for="barcode">Barcode</label>
                        <input type="text" class="form-control" id="barcode" maxlength="5" name="barcode" value="{{ $barang->barcode }}" placeholder="Masukkan barcode barang" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $barang->name }}" placeholder="Masukkan nama barang" required>
                    </div>
                    <div class="form-group">
                        <label for="hpp">Harga Pokok Penjualan</label>
                        <input type="number" class="form-control" id="hpp" name="hpp" value="{{ $barang->hpp }}" placeholder="Masukkan harga pokok penjualan barang">
                    </div>
                    <div class="form-group">
                        <label for="harga_jual">Harga Jual</label>
                        <input type="number" class="form-control" id="harga_jual" name="harga_jual" value="{{ $barang->harga_jual }}" placeholder="Masukkan harga jual">
                    </div>
                </div>
                <div class="box-footer">
                    <div class="box-tools">
                        <div class="pull-right">
                            <a href="{{ route('barang.index') }}" class="btn btn-sm btn-default">Tidak</a>
                        </div>
                        <div class="pull-left">
                            <input type="submit" class="btn btn-sm btn-danger" value="Ya, hapus data">
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection