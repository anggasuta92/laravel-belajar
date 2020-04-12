@extends('layouts.main')

@section('content')
 <form action="{{ route('jual.open.sesi.save') }}" method="post">
    @csrf
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i>Pilih lokasi penjualan</i></h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label>Lokasi penjualan</label>
                    <select name="" class="form-control select2">
                        @foreach($locations as $key => $location)
                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group input-group-sm">
                    <label>Customer</label>
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control cari_customer" id="cari_customer" name="cari_customer" placeholder="Pilih customer" value="" disabled>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-search-customer">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                    </div>
                    <input type="hidden" name="customer_id" id="customer_id" value="">
                </div>
            </div>
            <div class="box-footer">
                <div class="box-tools">
                    <div class="pull-right">
                        <a href="{{ route('jual.index') }}" class="btn btn-sm btn-primary">
                            <i class="glyphicon glyphicon-plus"></i> Lanjutkan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    var urlCustomerSearch = "{{ route('relasi.api.search') }}";
</script>


<div class="modal fade" id="modal-search-customer" class="modal-search-customer">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Default Modal</h4>
            </div>
            <div class="modal-body">
                <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->
@endsection