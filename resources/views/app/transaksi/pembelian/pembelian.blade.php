@extends('layouts.main')

@section('content')
    <form name="form-beli" id="form-beli" action="" method="post">
    @csrf
        <input type="hidden" name="pembelian_id" value="{{ $pembelian->id ?? '' }}">
        <input type="hidden" id="barang_id" name="barang_id" value="" required>
        <input type="hidden" id="item_id" name="item_id" value="" >
        <input type="hidden" id="type_input" name="type_input" value="detail" >

        <!-- main information -->
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h4 class="box-title"><i>Informasi Nota</i></h4>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="trans_date">Nomor Dokumen</label>
                        <input type="text" class="form-control" value="{{ $pembelian->number }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="trans_date">Lokasi</label>
                        <select class="form-control select2" name="lokasi_id">
                            @foreach($locations as $key => $location)
                            <option value="{{ $location->id }}" {{ ($pembelian->lokasi_id==$location->id || old('location_id') == $location->id) ? "selected":"" }} >{{ $location->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="trans_date">Tanggal Pembelian</label>
                        <input type="text" class="form-control" id="datepicker" name="trans_date" value="{{ ($pembelian->trans_date == "" && old('trans_date') == "") ? date('Y-m-d') : ($pembelian->trans_date ?? old('trans_date')) }}">
                    </div>
                    <div class="form-group">
                        <label for="relasi_id">Supplier</label>
                        <select class="form-control select2" name="relasi_id">
                            @foreach($relations as $key => $relasi)
                            <option value="{{ $relasi->id }}" {{ ($pembelian->relasi_id==$relasi->id || old('relasi_id')==$relasi->id) ? "selected":"" }} >{{ $relasi->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="supplier_inv_number">Nomor Nota Supplier</label>
                        <input type="text" class="form-control" value="{{ $pembelian->supplier_inv_number ?? old('supplier_inv_number') }}" id="supplier_inv_number" name="supplier_inv_number" placeholder="Masukkan nomor invoice supplier">
                    </div>
                    <div class="form-group">
                        <label for="note">Catatan</label>
                        <input type="text" class="form-control" id="note" name="note" placeholder="Ketikkan catatan untuk pembelian" value="{{ $pembelian->note ?? old('note') }}">
                        @error('note')
                            <span class="invalid-feedback text-danger" role="alert">
                                <strong>* <i>{{ $message }}</i></strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="box-footer">
                    <div class="box-tools">
                        
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i>Editor Detail Pembelian</i></h3>
                    <div class="box-tools">
                        @if($pembelian->id!="")
                        <!-- 
                        <a href="#"><i class="fa fa-print fa-2x text-primary"></i></a>
                        <a href="#"><i class="fa fa-file-excel-o fa-2x text-primary"></i></a>
                        -->
                        <a href="#" onClick="pdf('{{ $pembelian->id }}')"><i class="fa fa-file-pdf-o fa-2x text-primary"></i> PDF</a>
                        @endif
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-5">
                            @if($pembelian->status!="APPROVED")
                            <div class="form-group">
                                <label for="cari_barang">Pencarian barang</label>
                                <input type="text" class="form-control cari_barang" id="cari_barang" name="cari_barang" placeholder="Masukkan code/barcode/nama barang">
                            </div>
                            @endif
                        </div>
                        <div class="col-md-4" align="right"></div>
                        <div class="col-md-3" align="right">
                            <div class="form-group">
                                <label for="status">Set Status {{ $pembelian->status }} </label>
                                <select name="status" id="status" class="form-control">
                                    @if($pembelian->status != "APPROVED")
                                    <option value="PREPARED" {{ ($pembelian->status=="PREPARED" || $pembelian->status=="" ) ? "selected":"" }} >PREPARED</option>
                                    @endif
                                    <option value="APPROVED" {{ ($pembelian->status=="APPROVED") ? "selected":"" }}>APPROVED</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered" style="padding: 0 !important; margin: 0 !important;">
                                <tr>
                                    <td class="bg-light-blue" align="center">Code/Barcode</td>
                                    <td class="bg-light-blue" align="center">Nama Barang</td>
                                    <td class="bg-light-blue" align="center">Harga Beli</td>
                                    <td class="bg-light-blue" align="center">Qty</td>
                                    <td class="bg-light-blue" align="center">Total</td>
                                    <td class="bg-light-blue" align="center">Action</td>
                                </tr>
                                @if($pembelian->status!="APPROVED")
                                <tr>
                                    <td><input type="text" id="code_barang" size="15" value="" disabled></td>
                                    <td><input type="text" id="nama_barang" value="" disabled></td>
                                    <td><input type="text" id="price" style="text-align:right" class="number-format" size="12" name="price" value="" ></td>
                                    <td><input type="text" id="qty" style="text-align:right" class="number-format" size="5" name="qty" value="" ></td>
                                    <td><input type="text" id="total" size="12" name="total" value="" disabled></td>
                                    <td><button class="btn btn-sm btn-warning">Tambah</button></td>
                                </tr>
                                @endif

                                @php
                                    $total_qty = 0;
                                    $grand_total = 0;
                                @endphp

                                @foreach($details as $key => $detail)
                                <tr>
                                    <td><small>{{ $detail->barang->code }}/{{ $detail->barang->barcode }}</small></td>
                                    <td><small>{{ $detail->barang->name }}</small></td>
                                    <td align="right"><small>{{ number_format($detail->price,2) }}</small></td>
                                    <td align="right"><small>{{ number_format($detail->qty,2) }}</small></td>
                                    <td align="right"><small>{{ number_format($detail->qty *  $detail->price,2) }}</small></td>
                                    <td align="right">
                                        @if($detail->used_sn == 1)
                                            @if($pembelian->status!="APPROVED")
                                                <a href="{{ route('beli.serialnumber.show', $detail->id) }}" class="btn btn-xs btn-success">SN</a>
                                            @else
                                                <a href="javascript:showDetailSN('{{ $detail->id }}')" class="btn btn-xs btn-success">SN</a>
                                            @endif
                                        @endif
                                        @if($pembelian->status!="APPROVED")
                                        <!-- <a href="#"><i class="glyphicon glyphicon-pencil text-success"></i></a> -->
                                        <a href="javascript:confirmDeleteItem('{{ $detail->id }}','{{ $detail->barang->name }}')"><i class="glyphicon glyphicon-trash text-danger"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                    @php
                                        $total_qty += $detail->qty;
                                        $grand_total += ($detail->qty *  $detail->price);
                                    @endphp
                                @endforeach
                                <tr>
                                    <td colspan="3" class="bg-gray color-palette" align="right"><small><strong>TOTAL</strong></small></td>
                                    <td class="bg-gray color-palette" align="right"><small><strong>{{ number_format($total_qty, 2) }}</strong></small></td>
                                    <td class="bg-gray color-palette" align="right"><small><strong>{{ number_format($grand_total, 2) }}</strong></small></td>
                                    <td class="bg-gray color-palette"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    @if($pembelian->status!="APPROVED")
                    <button onClick="updateMain()" class="btn btn-success">Simpan Pembelian</button>
                    @endif
                    <a href="{{ route('beli.index') }}" class="btn btn-warning">Dokumen Baru</a>
                </div>
            </div>    
        </div>
    </form>

    <form name="form-del-item" id="form-del-item" action="{{ route('beli.detail.delete') }}" method="post">
        @csrf
        <input type="hidden" name="pembelian_id" value="{{ $pembelian->id ?? '' }}">
        <input type="hidden" name="del_item_id" id="del_item_id" value="">
    </form>
@endsection