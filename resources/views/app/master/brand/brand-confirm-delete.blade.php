@extends('layouts.main')

@section('content')
    <div class="col-md-5">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i>Apakah anda yakin akan menghapus data ini?</i></h3>
            </div>
            <form action="{{ route('brand.delete') }}" method="post" role="form">
                <div class="box-body">
                    @csrf
                    <input type="hidden" name="id" value="{{$brand->id}}">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$brand->name}}" placeholder="Masukkan nama brand" disabled>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="box-tools">
                        <div class="pull-right">
                            <a href="{{ route('brand.index') }}" class="btn btn-sm btn-default">Tidak</a>
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