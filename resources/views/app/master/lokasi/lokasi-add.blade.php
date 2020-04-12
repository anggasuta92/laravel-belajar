@extends('layouts.main')

@section('content')
    <div class="col-md-5">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i>Tambah Lokasi</i></h3>
            </div>

            <form action="{{ route('lokasi.save') }}" method="post" role="form">
                <div class="box-body">
                    @csrf
                    <div class="form-group">
                        <label for="code">Kode</label>
                        <input type="text" class="form-control" id="code" maxlength="10" name="code" placeholder="Masukkan kode lokasi" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama lokasi" required>
                    </div>               
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Masukkan alamat lokasi" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Telepon</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Masukkan no telepon lokasi">
                    </div>
                    <div class="form-group">
                        <label for="pic">Penanggung Jawab</label>
                        <input type="text" class="form-control" id="pic" name="pic" placeholder="Masukkan penanggung jawab">
                    </div>
                </div>
                <div class="box-footer">
                    <div class="box-tools">
                        <div class="pull-right">
                            <a href="{{ route('lokasi.index') }}" class="btn btn-sm btn-warning">Kembali</a>
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