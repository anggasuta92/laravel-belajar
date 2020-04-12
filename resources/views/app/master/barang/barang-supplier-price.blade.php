@extends('layouts.main')

@section('content')
    <div class="col-md-11">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i>Kelola harga beli supplier</i></h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="code">Kode</label>
                            <input type="text" class="form-control" id="code" maxlength="5" name="code" value="{{ $barang->code }} / {{ $barang->barcode }}" placeholder="" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="code">Nama Barang</label>
                            <input type="text" class="form-control" id="code" maxlength="5" name="code" value="{{ $barang->name }}" placeholder="" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th style="text-align:center;">Nama Supplier</th>
                                <th style="width: 150px; text-align:center;">Harga Beli</th>
                                <th style="width: 150px; text-align:center;">Created At</th>
                                <th style="width: 150px; text-align:center;">Updated At</th>
                                <th style="width: 80px; text-align:center;">Action</th>
                            </tr>
                            @foreach ($list_harga as $key => $harga)
                            <tr>
                                <td>
                                    {{ $harga->relasi->name }}
                                </td>
                                <td>{{ $harga->harga_beli }}</td>
                                <td style="text-align:center;"><small>{{ $harga->created_at }}</small></td>
                                <td style="text-align:center;"><small>{{ $harga->updated_at }}</small></td>
                                <td style="text-align:center;">
                                    <a href="{{ route('barang.detail',$barang->id) }}"><i class="glyphicon glyphicon-pencil text-success"></i></a>
                                    <a href="{{ route('barang.confirm',$barang->id) }}" ><i class="glyphicon glyphicon-trash text-danger"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
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
                            <a href="{{ route('barang.detail.supplier.add', $barang->id) }}" class="btn btn-sm btn-primary">
                                <i class="glyphicon glyphicon-plus"></i> Tambah Harga Beli
                            </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection