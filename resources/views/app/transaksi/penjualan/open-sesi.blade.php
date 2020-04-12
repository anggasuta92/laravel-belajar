@extends('layouts.main')

@section('content')
 <form action="{{ route('jual.open.sesi.save') }}" method="post">
    @csrf
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i>Opening Kasir</i></h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label>Tanggal opening</label>
                    <input type="text" name="open_date" id="digital-clock" value="" class="form-control text-center" disabled>
                </div>
                <div class="form-group">
                    <label>Shift</label>
                    <select name="" class="form-control">
                        @foreach($shifts as $key => $shift)
                        <option value="{{ $shift->id }}">{{ $shift->shift_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Modal Kasir</label>
                    <input type="text" name="open_amount" id="open_amount" value="" class="form-control text-right" required>
                </div>
            </div>
            <div class="box-footer">
                <div class="box-tools">
                    <div class="pull-right">
                        <a href="{{ route('beli.index') }}" class="btn btn-sm btn-primary">
                            <i class="glyphicon glyphicon-plus"></i> Simpan & lanjutkan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection