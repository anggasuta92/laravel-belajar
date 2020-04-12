@extends('layouts.main')

@section('content')
    <div class="col-md-5">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i>Tambah Satuan Barang</i></h3>
            </div>

            <form action="{{ route('satuan.save') }}" method="post" role="form">
                <div class="box-body">
                    
                        @csrf
                        <div class="form-group">
                            <label for="code">Kode</label>
                            <input type="text" class="form-control" id="code" maxlength="5" name="code" placeholder="Masukkan kode kategori" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama kategori" required>
                        </div>
                    
                </div>
                <div class="box-footer">
                    <div class="box-tools">
                        <div class="pull-right">
                            <a href="{{ route('satuan.index') }}" class="btn btn-sm btn-warning">Kembali</a>
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