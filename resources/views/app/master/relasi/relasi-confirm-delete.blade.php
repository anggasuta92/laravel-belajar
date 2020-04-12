@extends('layouts.main')

@section('content')
    <div class="col-md-5">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i>Apakah anda yakin akan menghapus data ini?</i></h3>
            </div>

            <form action="{{ route('relasi.delete') }}" method="post" role="form">
                <div class="box-body">
                    @csrf
                   <input type="hidden" name="id" value="{{ $relasi->id }}">
                    <div class="form-group">
                        <label for="code">Jenis Relasi</label>
                        <select class="form-control" name="type" disabled>
                            <option value="0">Supplier</option>
                            <option value="1">Customer / Member</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="code">Kode</label>
                        <input type="text" class="form-control" id="code" maxlength="10" value="{{ $relasi->code }}" name="code" placeholder="(Otomatis)" disabled>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $relasi->name }}" placeholder="Masukkan nama relasi" required disabled>
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ $relasi->address }}" placeholder="Masukkan alamat relasi" required disabled>
                    </div>
                <div class="box-footer">
                    <div class="box-tools">
                        <div class="pull-right">
                            <a href="{{ route('relasi.index') }}" class="btn btn-sm btn-warning">Kembali</a>
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