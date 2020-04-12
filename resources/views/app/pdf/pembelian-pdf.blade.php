@extends('layouts.printout')

@section('content')

    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
            <small>Surya Jaya Celluler<br/></small>
          BUKTI PEMBELIAN BARANG
          <small class="pull-right">Printed by : {{ Auth::user()->name }} - {{ date('Y-m-d') }}</small>
        </h2>
      </div>
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-3 invoice-col">
            <u>Supplier :</u>
            <address>
                <strong>{{ "[".  $pembelian->relasi->code . "] " . $pembelian->relasi->name }}</strong><br>
                Address : {{ $pembelian->relasi->address }} <br/>
                Phone : {{ $pembelian->relasi->phone }}
            </address>
        </div>
        <div class="col-sm-3 invoice-col">
            <u>Diterima di lokasi :</u>
            <address>
                <strong>{{ "[".  $pembelian->lokasi->code . "] " . $pembelian->lokasi->name }}</strong><br>
                Address : {{ $pembelian->lokasi->address }} <br/>
                Phone : {{ $pembelian->lokasi->phone }}
            </address>
        </div>
      <!-- /.col -->
      <!-- /.col -->
      <div class="col-sm-6 invoice-col">
        <b>Nomor Dokumen #{{ $pembelian->number }}</b><br>
        <br>
        <b>Tanggal transaksi:</b> {{ $pembelian->trans_date }}<br>
        <b>Jatuh Tempo:</b> {{ $pembelian->due_date ?? "-" }}<br>
        <b>Keterangan:</b> {{ $pembelian->note }}
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>#</td>
                        <th>Barang</th>
                        <th>Keterangan</th>
                        <th>Harga Beli</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $gtot = 0;
                        $gtotQty = 0;
                    @endphp
                    @foreach($details as $key => $detail)
                    <tr>
                        <td align="right"><small>{{ $key + 1 }}</small></td>
                        <td><small>{{ $detail->barang->code . "/" . $detail->barang->name }}</small></td>
                        <td><small>-</small></td>
                        <td align="right"><small>{{ number_format($detail->price, 2) }}</small></td>
                        <td align="right"><small>{{ number_format($detail->qty, 2) }}</small></td>
                        <td align="right"><small>{{ number_format($detail->qty * $detail->price, 2) }}</small></td>
                    </tr>
                    @php
                        $gtot += ($detail->qty * $detail->price);
                        $gtotQty += $detail->qty;
                    @endphp
                    @endforeach
                    <tr>
                        <td colspan="3">&nbsp;</td>
                        <td>Grand Total</td>
                        <td align="right">{{ number_format($gtotQty, 2) }}</td>
                        <td align="right">{{ number_format($gtot, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-4">
            <div class="box box-default">
                <div class="box-header with-border" align="center">Diterima/catat oleh</div>
                <div class="box-body">
                    <br/><br/>
                </div>
            </div>
        </div>
    </div>

@endsection