@extends('layouts.main')

@section('content')
 <form action="{{ route('jual.open.sesi.save') }}" method="post">
    @csrf
    <div class="col-md-4">
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
            </div>
            <div class="box-footer">
                <div class="box-tools">
                    <div class="pull-right">
                        <a href="{{ route('beli.index') }}" class="btn btn-sm btn-primary">
                            <i class="glyphicon glyphicon-plus"></i> Lanjutkan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection