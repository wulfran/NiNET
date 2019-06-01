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
                                <div class="v-app">
                                    <fieldset>
                                        <legend>Pozycje na fakturze</legend>
                                        <invoice-table :rows='@json($invoice->rows)'></invoice-table>
                                    </fieldset>
                                </div>
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

    {!! form_start($companyForm) !!}
        <div class="modal fade" id="add_company" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Dodaj firmę</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                {!! form_row($companyForm->name) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                {!! form_row($companyForm->short_name) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                {!! form_row($companyForm->email) !!}
                            </div>
                            <div class="col-md-6">
                                {!! form_row($companyForm->phone) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                {!! form_row($companyForm->nip) !!}
                            </div>
                            <div class="col-md-6">
                                {!! form_row($companyForm->regon) !!}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-9">
                                {!! form_row($companyForm->address->street_name) !!}
                            </div>
                            <div class="col-md-3">
                                {!! form_row($companyForm->address->street_number) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                {!! form_row($companyForm->address->post_code) !!}
                            </div>
                            <div class="col-md-9">
                                {!! form_row($companyForm->address->city) !!}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Zamknij</button>
                        {!! form_row($companyForm->submit, ['attr' => ['width' => '50%']]) !!}
                    </div>
                </div>
            </div>
        </div>
    <div id="remove">
        {!! form_row($companyForm->phone_2) !!}
        {!! form_row($companyForm->description) !!}
    </div>
    {!! form_end($companyForm) !!}
@stop

@section('js')
    <script id="invoice-table" type="template">
        <div>
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th style="width: 40px;"></th>
                    <th>Nazwa towaru lub usługi</th>
                    <th style="width: 100px;">Ilość</th>
                    <th style="width: 150px;">Jednostka</th>
                    <th style="width: 150px;">Cena jedn. brutto</th>
                    <th style="width: 150px;">VAT</th>
                    <th style="width: 40px;"></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(row, index) in localRows">
                    <td>@{{ index+1 }}.</td>
                    <td>
                        <input required v-model="row.name" :name="'rows['+index+'][name]'" class="form-control"/>
                    </td>
                    <td><input required type="number" v-model="row.quantity"
                               :name="'rows['+index+'][quantity]'" class="form-control"/></td>
                    <td><input required v-model="row.unit" :name="'rows['+index+'][unit]'"
                               class="form-control"/></td>
                    <td><input required type="number" v-model="row.price"
                               :name="'rows['+index+'][price]'" class="form-control"/></td>
                    <td>
                        <select required class="form-control" v-model="row.vat" :name="'rows['+index+'][vat]'">
                            <option value="23">23%</option>
                            <option value="8">8%</option>
                            <option value="5">5%</option>
                            <option value="0">0%</option>
                            <option value="zw.">zw.</option>
                        </select>
                    </td>
                    <td>
                        <a @click="removeRow(index)"
                           class="btn btn-danger btn-sm"><i title="Usuń pozycje"
                                                            class="fa fa-remove"></i></a>
                    </td>
                </tr>
                </tbody>
            </table>
            <button @click.prevent="addRow" class="btn btn-primary"><i class="fa fa-plus"></i> Dodaj
                pozycje
            </button>
        </div>
    </script>


    <script>
        function calculateValues(){
            let quantity = $("#quantity").val();
            let price_netto = $("#price_netto").val();
            let vat = $("#vat").val();
            let vat_value;
            let price_brutto;
            if(quantity && price_netto){
                vat_value = parseFloat(quantity) * parseFloat(vat);
                price_brutto = parseFloat(price_netto) + parseFloat(vat_value);
                console.log(vat_value);
                console.log(price_brutto);
            }
        }
        function setCompanyType(type){
            console.log(type);
        }
        $(document).ready(function () {
            $("#remove").remove();
        });
    </script>
@stop