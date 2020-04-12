@extends('layouts.main')

@section('content')
    <div class="col-md-6">
        <form action="{{ route('barang.detail.supplier.save', ['idbarang'=>$barang->id]) }}" method="post" role="form">
            @csrf
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i>Tambah harga beli supplier</i></h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="code">Kode</label>
                                <input type="text" class="form-control" id="code" maxlength="5" name="code" value="{{ $barang->code }} / {{ $barang->barcode }}" placeholder="" disabled>
                            </div>
                            <div class="form-group">
                                <label for="code">Nama Barang</label>
                                <input type="text" class="form-control" id="code" maxlength="5" name="code" value="{{ $barang->name }}" placeholder="" disabled>
                            </div>
                            <div class="form-group">
                                <label for="relasi_id">Supplier</label>
                                <select class="form-control" name="relasi_id">
                                    @foreach ($relasies as $key => $relasi)
                                    <option value="{{ $relasi->id }}">{{ $relasi->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="harga_beli">Harga Beli</label>
                                <input type="text" class="form-control" id="harga_beli" maxlength="5" name="harga_beli" value="" placeholder="" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="box-tools">
                        <div class="pull-right">
                            <a href="{{ route('barang.detail',$barang->id) }}" class="btn btn-sm btn-warning">
                                    <i class="glyphicon glyphicon-arrow-left"></i> Kembali ke detail barang
                                </a>
                        </div>
                        <div class="pull-left">
                                <input type="submit" class="btn btn-sm btn-primary" value="Simpan Harga Beli">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection