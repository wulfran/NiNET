@extends('adminlte::page')

@section('content_header')
    <h1>{{ $title }}</h1>
@stop

@section('content')
    {!! form_start($form, ['enctype' => 'multipart/form-data']) !!}
    <div class="panel panel-default">
        <div class="panel-heading">Formularz</div>
        <div class="panel-body">
            <div class="box box-info">
                <div class="box-header">Czas</div>
                <div class="box-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                {!! form_row($form->start) !!}
                            </div>
                            <div class="col-md-6">
                                {!! form_row($form->end) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                {!! form_row($form->notes) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                {!! form_row($form->submit) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! form_end($form, false) !!}
@stop

@push('js')
    <script>
        $('#start').datepicker({
            format: 'yyyy-mm-dd'
        });
        $('#end').datepicker({
            format: 'yyyy-mm-dd'
        });
    </script>
@endpush