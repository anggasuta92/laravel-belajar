@extends('layouts.main')

@section('content')
    <form action="{{ route('beli.serialnumber.update',$detail->id) }}" method="post">
    @csrf
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i>Detail Pembelian</i></h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="trans_date">Code / Barcode</label>
                        <input type="text" class="form-control" value="{{ $detail->barang->code . ' / ' . $detail->barang->barcode }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="trans_date">Nama Barang</label>
                        <input type="text" class="form-control" value="{{ $detail->barang->name }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="trans_date">Harga Beli</label>
                        <input type="text" class="form-control" value="{{ number_format($detail->price,2) }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="trans_date">Qty</label>
                        <input type="text" class="form-control" value="{{ number_format($detail->qty,2) }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="trans_date">Total</label>
                        <input type="text" class="form-control" value="{{ number_format($detail->qty * $detail->price,2) }}" disabled>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i>Serial Number / IMEI</i></h3>
                </div>
                <div class="box-body">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <td class="bg-light-blue" align="center" colspan="3">Serial Number List</td>
                        </tr>
                        @foreach ($serial_numbers as $key => $sn)
                        <tr>
                            <td width="40">
                                {{ $key + 1 }}
                            </td>
                            <td>
                                {{ $sn->serial_number }}
                            </td>
                            <td width="30">
                                <a href="javascript:deleteSN('{{ $sn->id }}','{{ $sn->serial_number }}')"><i class="glyphicon glyphicon-trash text-danger"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    <div class="form-group">
                        <input type="text" class="form-control" id="serial_number" name="serial_number" placeholder="Masukkan serial number" required>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="box-tools">
                        <div class="pull-left">
                            <button class="btn btn-sm btn-primary">
                                <i class="glyphicon glyphicon-plus"></i> Simpan detail SN/IMEI
                            </button>
                            <a href="{{ route('beli.index', ['pembelian'=>$detail->pembelian_id]) }}" class="btn btn-sm btn-success">
                                <i class=""></i> Selesai
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form name="form-del-sn" id="form-del-sn" action="{{ route('beli.serialnumber.delete') }}" method="post">
        @csrf
        <input type="hidden" name="detail_id" value="{{ $detail->id ?? '' }}">
        <input type="hidden" name="sn_id" id="sn_id" value="">
    </form>
@endsection