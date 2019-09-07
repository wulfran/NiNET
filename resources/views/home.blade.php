@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4" style="font-size: 24px">
            <p>W tym miesiącu przepracowane {{ $minutes }}</p>
            <p>Do celu ({{ $goal }}) min pozostało: {{ $todo }}</p>
            <p>Wymagane dziennie: {{ $daily }} minut</p>
        </div>
        <div class="col-md-4" style="font-size: 24px">
            <p>Obecny zysk: {{ $currentProfit }}</p>
        </div>
    </div>
@stop
