@extends('layouts.main')

@section('content')
    <div class="col-md-5">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i>Ubah Satuan Barang</i></h3>
            </div>
            <form action="{{ route('satuan.update') }}" method="post" role="form">
                <div class="box-body">
                    @csrf
                    <input type="hidden" name="id" value="{{$satuan->id}}">
                    <div class="form-group">
                        <label for="code">Kode</label>
                        <input type="text" class="form-control" id="code" name="code" maxlength="5" value="{{$satuan->code}}" placeholder="Masukkan kode kategori" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$satuan->name}}" placeholder="Masukkan nama kategori" required>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="box-tools">
                        <div class="pull-right">
                            <a href="{{ route('satuan.index') }}" class="btn btn-sm btn-warning">Kembali</a>
                        </div>
                        <div class="pull-left">
                            <input type="submit" class="btn btn-sm btn-primary" value="Simpan Perubahan">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection