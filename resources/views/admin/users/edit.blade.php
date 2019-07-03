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
                <div class="box-header">Dane podstawowe</div>
                <div class="box-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                {!! form_row($form->name) !!}
                            </div>
                            <div class="col-md-4">
                                {!! form_row($form->first_name) !!}
                            </div>
                            <div class="col-md-4">
                                {!! form_row($form->last_name) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                {!! form_row($form->email) !!}
                            </div>
                            <div class="col-md-4">
                                {!! form_row($form->phone) !!}
                            </div>
                            <div class="col-md-4">
                                {!! form_row($form->account_type) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box box-info">
                <div class="box-header">Adres</div>
                <div class="box-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                {!! form_row($form->address->street_name) !!}
                            </div>
                            <div class="col-md-2">
                                {!! form_row($form->address->street_number) !!}
                            </div>
                            <div class="col-md-2">
                                {!! form_row($form->address->post_code) !!}
                            </div>
                            <div class="col-md-4">
                                {!! form_row($form->address->city) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-2 pull-right">
                        {!! form_row($form->submit) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! form_end($form) !!}
@stop