@extends('layouts.main')

@section('content')
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i>Daftar Brand Barang</i></h3>

                <div class="box-tools">
                    <form action="" method="get">
                    <div class="input-group input-group-sm hidden-xs" style="width: 350px;">
                        <input type="text" name="q" class="form-control pull-right" placeholder="Search">
                        <div class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th style="text-align:center;">Nama Satuan</th>
                        <th style="width: 150px; text-align:center;">Created At</th>
                        <th style="width: 150px; text-align:center;">Updated At</th>
                        <th style="width: 80px; text-align:center;">Action</th>
                    </tr>
                    @foreach ($brands as $key => $brand)
                    <tr>
                        <td>{{ $brand->name }}</td>
                        <td style="text-align:center;"><small>{{ $brand->created_at }}</small></td>
                        <td style="text-align:center;"><small>{{ $brand->updated_at }}</small></td>
                        <td style="text-align:center;">
                            <a href="{{ route('brand.detail',$brand->id) }}"><i class="glyphicon glyphicon-pencil text-success"></i></a>
                            <a href="{{ route('brand.confirm',$brand->id) }}" ><i class="glyphicon glyphicon-trash text-danger"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <div class="box-footer">
                <div class="box-tools">
                    <div class="pull-right">
                        {{ $brands->links() }}
                    </div>
                    <div class="pull-left">
                        <ul class="pagination">
                            <a href="{{ route('brand.add') }}" class="btn btn-sm btn-primary">
                                <i class="glyphicon glyphicon-plus"></i> Tambah Brand/Merk
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection