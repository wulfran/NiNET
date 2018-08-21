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
                            <div class="col-md-6">
                                {!! form_row($form->name) !!}
                            </div>
                            <div class="col-md-6">
                                {!! form_row($form->short_name) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                {!! form_row($form->nip) !!}
                            </div>
                            <div class="col-md-6">
                                {!! form_row($form->regon) !!}
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
                                {!! form_row($form->phone_2) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                {!! form_row($form->description) !!}
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
                                {!! form_row($form->address->street_name, ['attr'=> ['required' => 'required']]) !!}
                            </div>
                            <div class="col-md-2">
                                {!! form_row($form->address->street_number, ['attr'=> ['required' => 'required']]) !!}
                            </div>
                            <div class="col-md-2">
                                {!! form_row($form->address->post_code) !!}
                            </div>
                            <div class="col-md-4">
                                {!! form_row($form->address->city, ['attr'=> ['required' => 'required']]) !!}
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
