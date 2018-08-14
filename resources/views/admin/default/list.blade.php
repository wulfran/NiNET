@extends('adminlte::page')

@section('content')
<div class="panel panel-info">
    <div class="panel-heading">{{ $heading }}</div>
    <div class="panel-body">
        <table class="table" id="data_table">
            {!! $table !!}
        </table>
    </div>
</div>
@stop

@section('js')
    <script>
        console.log('ok');
        $("#data_table").DataTable({
            "columns": [
                {"width": "5%"},
                null,
                null,
                null,
                {"width": "10%"},
            ]
        });
    </script>
@stop