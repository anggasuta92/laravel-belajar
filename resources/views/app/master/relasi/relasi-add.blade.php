@extends('layouts.main')

@section('content')
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i>Tambah Relasi (Supplier & Customer)</i></h3>
            </div>

            <form action="{{ route('relasi.save') }}" method="post" role="form">
                <div class="box-body">
                    @csrf

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="code">Jenis Relasi</label>
                            <select class="form-control" name="type">
                                <option value="0">Supplier</option>
                                <option value="1">Customer / Member</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="code">Kode</label>
                            <input type="text" class="form-control" id="code" maxlength="10" name="code" placeholder="(Otomatis)" disabled>
                        </div>
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama relasi" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Masukkan alamat relasi" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Telepon</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Masukkan nomor telepon relasi" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email relasi">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="website">Website</label>
                            <input type="text" class="form-control" id="website" name="website" placeholder="Masukkan website relasi">
                        </div>
                        <div class="form-group">
                            <label for="id_card_number">KTP/SIM</label>
                            <input type="text" class="form-control" id="id_card_number" name="id_card_number" placeholder="Masukkan nomor KTP/SIM">
                        </div>
                        <div class="form-group">
                            <label for="tax_id_number">NPWP</label>
                            <input type="text" class="form-control" id="tax_id_number" name="tax_id_number" placeholder="Masukkan nomor NPWP">
                        </div>
                        <div class="form-group">
                            <label for="ar_limit">Batas Penjualan Kredit</label>
                            <input type="text" class="form-control" id="ar_limit" name="ar_limit" placeholder="Masukkan total batas penjualan secara kredit">
                        </div>
                        <div class="form-group">
                            <label for="ap_limit">Batas Penjualan Kredit</label>
                            <input type="text" class="form-control" id="ap_limit" name="ap_limit" placeholder="Masukkan total batas pembelian secara kredit">
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="box-tools">
                        <div class="pull-right">
                            <a href="{{ route('relasi.index') }}" class="btn btn-sm btn-warning">Kembali</a>
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