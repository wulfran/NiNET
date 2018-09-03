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
                            <div class="col-md-3">
                                {!! form_row($form->number) !!}
                            </div>
                            <div class="col-md-3">
                                {!! form_row($form->issued_by) !!}
                            </div>
                            <div class="col-md-3">
                                {!! form_row($form->place) !!}
                            </div>
                            <div class="col-md-3">
                                {!! form_row($form->payment_method) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                {!! form_row($form->sold_at) !!}
                            </div>
                            <div class="col-md-3">
                                {!! form_row($form->payment_date) !!}
                            </div>
                            <div class="col-md-3">
                                {!! form_row($form->is_paid) !!}
                            </div>
                            <div class="col-md-3">
                                <label for="overdue">Po terminie</label>
                                <input class="form-control" type="text" id="overdue" name="overdue" value="@if(isset($invoice->id) && $invoice->overdue() == TRUE) Tak @else Nie @endif" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                {!! form_row($form->value_netto) !!}
                            </div>
                            <div class="col-md-3">
                                {!! form_row($form->vat_percentage) !!}
                            </div>
                            <div class="col-md-3">
                                {!! form_row($form->value_vat) !!}
                            </div>
                            <div class="col-md-3">
                                {!! form_row($form->value_brutto) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box box-info">
                <div class="box-header">Dane firm</div>
                <div class="box-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box box-primary">
                                    <div class="box-header">Sprzedawca</div>
                                    <div class="box-body">
                                        @if(isset($invoice->seller_id))
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <strong>Nazwa:</strong>
                                                </div>
                                                <div class="col-md-9">
                                                    {{ $invoice->seller->name }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <strong>Adres:</strong>
                                                </div>
                                                <div class="col-md-9">
                                                    {{ $invoice->seller->getMainAddress()->street_name . ' ' . $invoice->seller->getMainAddress()->street_number}},
                                                    <br>
                                                    {{ $invoice->seller->getMainAddress()->post_code . ' ' . $invoice->seller->getMainAddress()->city }}
                                                    <br>
                                                    {{ $invoice->seller->getMainAddress()->country}}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <strong>NIP:</strong>
                                                </div>
                                                <div class="col-md-9">
                                                    {{ $invoice->seller->nip }}
                                                </div>
                                            </div>
                                        @else
                                            <div class="row">
                                                <div class="col-md-12">
                                                    {!! form_row($form->seller_id) !!}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <span data-toggle="modal" data-target="#add_company" onclick="setCompanyType(1)" class="btn btn-primary btn-md">Dodaj spoza listy</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box box-primary">
                                    <div class="box-header">Nabywca</div>
                                    <div class="box-body">
                                        @if(isset($invoice->buyer_id))
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <strong>Nazwa:</strong>
                                                </div>
                                                <div class="col-md-9">
                                                    {{ $invoice->buyer->name }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <strong>Adres:</strong>
                                                </div>
                                                <div class="col-md-9">
                                                    {{ $invoice->buyer->getMainAddress()->street_name . ' ' . $invoice->buyer->getMainAddress()->street_number }}
                                                    <br>
                                                    {{ $invoice->buyer->getMainAddress()->post_code . ' ' . $invoice->buyer->getMainAddress()->city}}
                                                    <br>
                                                    {{ $invoice->buyer->getMainAddress()->country }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <strong>NIP:</strong>
                                                </div>
                                                <div class="col-md-9">
                                                    {{ $invoice->buyer->nip }}
                                                </div>
                                            </div>
                                        @else
                                            <div class="row">
                                                <div class="col-md-12">
                                                    {!! form_row($form->buyer_id) !!}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <span data-toggle="modal" data-target="#add_company" onclick="setCompanyType(2)" class="btn btn-primary btn-md">Dodaj spoza listy</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box box-info">
                <div class="box-header">Pozycje</div>
                <div class="box-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                tu będzie tabelka
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="box box-info">
                <div class="box-header">Podsumowanie</div>
                <div class="box-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8">
                                {!! form_row($form->comments) !!}
                            </div>
                            <div class="col-md-4">
                                {!! form_row($form->bank_account) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! form_end($form) !!}


    <div class="modal fade" id="add_company" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Dodaj firmę</h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Zamknij</button>
                    <button type="button" class="btn btn-primary">Zapisz</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@stop

@section('js')
    <script>
        function setCompanyType(type){
            console.log(type);
        }
    </script>
@stop