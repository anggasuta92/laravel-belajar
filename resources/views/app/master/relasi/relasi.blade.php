@extends('layouts.main')

@section('content')
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i>Daftar Relasi</i></h3>

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
                        <th style="width: 100px; text-align:center;">Kode</th>
                        <th style="width: 100px; text-align:center;">Jenis</th>
                        <th style="text-align:center;">Nama Relasi</th>
                        <th style="text-align:center;">Detail</th>
                        <th style="width: 150px; text-align:center;">Created At</th>
                        <th style="width: 150px; text-align:center;">Updated At</th>
                        <th style="width: 50px; text-align:center;">Action</th>
                    </tr>
                    @foreach ($relations as $key => $relasi)
                    <tr>
                        <td style="text-align:center;">{{ $relasi->code }}</td>
                        <td>{{ $relasi->type === 0 ? "Supplier":"Customer" }}</td>
                        <td>{{ $relasi->name }}</td>
                        <td>{{ $relasi->phone }} / {{ $relasi->address }}</td>
                        <td style="text-align:center;"><small>{{ $relasi->created_at }}</small></td>
                        <td style="text-align:center;"><small>{{ $relasi->updated_at }}</small></td>
                        <td style="text-align:center;">
                            <a href="{{ route('relasi.detail',$relasi->id) }}"><i class="glyphicon glyphicon-pencil text-success"></i></a>
                            <a href="{{ route('relasi.confirm',$relasi->id) }}" ><i class="glyphicon glyphicon-trash text-danger"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <div class="box-footer">
                <div class="box-tools">
                    <div class="pull-right">
                        {{ $relations->links() }}
                    </div>
                    <div class="pull-left">
                        <ul class="pagination">
                            <a href="{{ route('relasi.add') }}" class="btn btn-sm btn-primary">
                                <i class="glyphicon glyphicon-plus"></i> Tambah Relasi
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection