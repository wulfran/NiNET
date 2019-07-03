@extends('adminlte::page')


@section('content')
    <div class="row">
        <div class="col-md-12">
            <img src="{{ asset('img/logo.svg') }}" alt="">
        </div>
    </div>
    <div class="row">
        <form action="{{ route('admin.timers.print') }}">
            {{ csrf_field() }}
            <div class="col-md-3">
                <label for="start">Data od</label>
                <input type="text" class="form-control" name="start" id="start" required>
            </div>
            <div class="col-md-3">
                <label for="end">Data do</label>
                <input type="text" class="form-control" name="end" id="end" required>
            </div>
            <div class="col-md-3">
                <button class="btn btn-md btn-primary" style="margin-top:25px;">Drukuj</button>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script>
        $("#start").datepicker({
            format: 'yyyy-mm-dd'
        });

        $('#end').datepicker({
            format: 'yyyy-mm-dd'
        });

    </script>
@endpush