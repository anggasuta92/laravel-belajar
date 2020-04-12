@extends('layouts.main')

@section('content')
    <form action="{{ route('beli.serialnumber.save',['detail'=>$detail]) }}" method="post">
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
                    @for ($i = 0; $i < $detail->qty; $i++)
                    <div class="form-group">
                        <input type="text" class="form-control" id="serial_number" name="serial_number_{{ $i }}" placeholder="Masukkan serial numbe ke-{{ $i + 1 }}" required>
                    </div>
                    @endfor
                </div>
                <div class="box-footer">
                    <div class="box-tools">
                        <div class="pull-left">
                            <button class="btn btn-sm btn-primary">
                                <i class="glyphicon glyphicon-plus"></i> Simpan detail SN/IMEI
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection