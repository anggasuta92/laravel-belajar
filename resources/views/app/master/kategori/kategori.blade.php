@extends('layouts.main')

@section('content')
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i>Daftar Kategori Barang</i></h3>
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
                        <th style="width: 150px; text-align:center;">Kode</th>
                        <th style="text-align:center;">Nama Kategori</th>
                        <th style="width: 150px; text-align:center;">Created At</th>
                        <th style="width: 150px; text-align:center;">Updated At</th>
                        <th style="width: 80px; text-align:center;">Action</th>
                    </tr>
                    @foreach ($kategories as $key => $kategori)
                    <tr>
                        <td style="text-align:center;">{{ $kategori->code }}</td>
                        <td>{{ $kategori->name }}</td>
                        <td style="text-align:center;"><small>{{ $kategori->created_at }}</small></td>
                        <td style="text-align:center;"><small>{{ $kategori->updated_at }}</small></td>
                        <td style="text-align:center;">
                            <a href="{{ route('kategori.detail',$kategori->id) }}"><i class="glyphicon glyphicon-pencil text-success"></i></a>
                            <!-- <a href="{{ route('kategori.confirm',$kategori->id) }}"  data-toggle="modal" data-target="#modal-default"><i class="glyphicon glyphicon-trash text-danger"></i></a> -->
                            <a href="{{ route('kategori.confirm',$kategori->id) }}" ><i class="glyphicon glyphicon-trash text-danger"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <div class="box-footer">
                <div class="box-tools">
                    <div class="pull-right">
                        {{ $kategories->links() }}
                    </div>
                    <div class="pull-left">
                        <ul class="pagination">
                            <a href="{{ route('kategori.add') }}" class="btn btn-sm btn-primary">
                                <i class="glyphicon glyphicon-plus"></i> Tambah Kategori
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection