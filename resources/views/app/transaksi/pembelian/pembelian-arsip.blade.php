@extends('layouts.main')

@section('content')
 
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i>Arsip Pembelian</i></h3>

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
                        <th style="width: 80px; text-align:center;">Tanggal</th>
                        <th style="width: 200px; text-align:left;">Supplier</th>
                        <th style="width: 130px; text-align:center;">Nomor</th>
                        <th style="text-align:left;">Keterangan</th>
                        <th style="width: 150px; text-align:center;">Status</th>
                        <th style="width: 150px; text-align:center;">Updated At</th>
                        <th style="width: 80px; text-align:center;">Action</th>
                    </tr>
                    @foreach ($pembelians as $key => $pembelian)
                    <tr>
                        <td style="text-align:center;"><small>{{ $pembelian->trans_date }}</small></td>
                        <td style="text-align:left;"><small>{{ $pembelian->relasi->name }}</small></td>
                        <td style="text-align:center;"><small>{{ $pembelian->number }}</small></td>
                        <td style="text-align:left;"><small>{{ $pembelian->note }}</small></td>
                        <td style="text-align:center;"><small>{{ $pembelian->status === "" ? "PREPARED" : "APPROVED" }}</small></td>
                        <td style="text-align:center;"><small>{{ $pembelian->updated_at }}</small></td>
                        <td style="text-align:center;">
                            @if($pembelian->status === "" || $pembelian->status === "PREPARED" )
                            <a href="{{ route('beli.index', ['pembelian'=>$pembelian]) }}"><i class="glyphicon glyphicon-pencil text-success"></i></a>
                            <a href="{{ route('satuan.confirm',$pembelian->id) }}" ><i class="glyphicon glyphicon-trash text-danger"></i></a>
                            @else
                            <a href="{{ route('beli.index', ['pembelian'=>$pembelian]) }}"><i class="fa fa-eye text-success"></i></a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <div class="box-footer">
                <div class="box-tools">
                    <div class="pull-right">
                        {{ $pembelians->links() }}
                    </div>
                    <div class="pull-left">
                        <ul class="pagination">
                            <a href="{{ route('beli.index') }}" class="btn btn-sm btn-primary">
                                <i class="glyphicon glyphicon-plus"></i> Pembelian Baru
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection