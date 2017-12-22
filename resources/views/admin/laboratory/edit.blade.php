@extends('layouts.app')

@section('content')
    {!! Form::model($lab, ['method' => 'PUT', 'route' => ['laboratorio.update', $lab->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>@lang('global.app_edit')  - {{$lab->lab_name}}</h4>
        </div>

        <div class="panel-body">

            <fieldset class="group-border">
                <legend class="group-border">Info</legend>
                <div class="col-xs-9 form-group">
                    {!! Form::label('lab_name', 'Laboratorio*', ['class' => 'control-label']) !!}
                    {!! Form::text('lab_name', old('Laboratorio'), ['class' => 'form-control', 'placeholder' => 'Inserisci il Nome', 'required' => '']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('icar_code', 'Codice Laboratorio*', ['class' => 'control-label']) !!}
                    {!! Form::text('icar_code', old('Codice Laboratorio'), ['class' => 'form-control', 'placeholder' => 'Inserisci il codice', 'required' => '']) !!}
                </div>

                <div class="col-xs-6 form-group">
                    {!! Form::label('nominativo_contatto', 'Nominativo Contatto*', ['class' => 'control-label']) !!}
                    {!! Form::text('nominativo_contatto', old('Nominativo Contatto'), ['class' => 'form-control', 'placeholder' => 'Inserisci Nominativo Contatto', 'required' => '']) !!}
                </div>

                <div class="col-xs-6 form-group">
                    {!! Form::label('email', 'Email*', ['class' => 'control-label']) !!}
                    {!! Form::text('email', old('Email'), ['class' => 'form-control', 'placeholder' => 'Inserisci Email', 'required' => '']) !!}
                </div>


                <div class="col-xs-4 form-group">
                    {!! Form::label('spedizione_address', 'Indirizzo spedizione*', ['class' => 'control-label']) !!}
                    {!! Form::text('spedizione_address', old('Indirizzo spedizione'), ['class' => 'form-control', 'placeholder' => 'Inserisci Indirizzo spedizione', 'required' => '']) !!}
                </div>

                <div class="col-xs-2 form-group">
                    {!! Form::label('spedizione_cap', 'Cap*', ['class' => 'control-label']) !!}
                    {!! Form::text('spedizione_cap', old('Cap'), ['class' => 'form-control', 'placeholder' => 'Inserisci Cap', 'required' => '']) !!}
                </div>

                <div class="col-xs-3 form-group">
                    {!! Form::label('spedizione_city', 'Citt&agrave;*', ['class' => 'control-label']) !!}
                    {!! Form::text('spedizione_city', old('Citt&agrave;'), ['class' => 'form-control', 'placeholder' =>
                    'Inserisci Citt&agrave;', 'required' => '']) !!}
                </div>

                <div class="col-xs-3 form-group">

                    {!! Form::label('spedizione_country', 'Nazione*', ['class' => 'control-label']) !!}
                    {{ Form::select ('spedizionecountry', $countries, $lab->spedizione_country , ['class' => 'form-control','id' =>'spedizionecountry']) }}
                </div>

            </fieldset>

            <br>

            <fieldset class="group-border">
                <legend class="group-border">Scegli Test</legend>
                @if (count($tests) > 0)
                    @foreach ($tests as $test)
                        <div class="col-xs-2 form-group">
                            {!! Form::label($test->code, strtoupper($test->code), ['class' => 'control-label']) !!}
                            {{ Form::selectRange($test->code, 0, 10, $lab->{$test->code}, ['class' => 'form-control']) }}
                        </div>
                    @endforeach
                @endif
            </fieldset>

            <br>
            <fieldset class="group-border">
                <legend class="group-border">Fatturazione</legend>
                <div class="col-xs-6 form-group">
                    {!! Form::label('contatto_amministrativo', 'Contatto amministrativo*', ['class' => 'control-label']) !!}
                    {!! Form::text('contatto_amministrativo', old('Contatto amministrativo'), ['class' => 'form-control', 'placeholder' => 'Inserisci Contatto amministrativo', 'required' => '']) !!}
                </div>

                <div class="col-xs-6 form-group">
                    {!! Form::label('email_amministrativa', 'Email amministrativa*', ['class' => 'control-label']) !!}
                    {!! Form::text('email_amministrativa', old('Email amministrativa'), ['class' => 'form-control', 'placeholder' => 'Inserisci Email amministrativa', 'required' => '']) !!}
                </div>


                <div class="col-xs-6 form-group">
                    {!! Form::label('ente_associato', 'Ente associato*', ['class' => 'control-label']) !!}
                    {!! Form::text('ente_associato', old('Ente associato'), ['class' => 'form-control', 'placeholder' => 'Inserisci Ente associato', 'required' => '']) !!}
                </div>


                <div class="col-xs-6 form-group">
                    {!! Form::label('vat_number', 'Vat number*', ['class' => 'control-label']) !!}
                    {!! Form::text('vat_number', old('Vat number'), ['class' => 'form-control', 'placeholder' => 'Inserisci Vat number', 'required' => '']) !!}
                </div>


                <div class="col-xs-4 form-group">
                    {!! Form::label('invoice_address', 'Indirizzo fatturazione*', ['class' => 'control-label']) !!}
                    {!! Form::text('invoice_address', old('Indirizzo fatturazione'), ['class' => 'form-control', 'placeholder' => 'Inserisci Indirizzo fatturazione', 'required' => '']) !!}
                </div>

                <div class="col-xs-2 form-group">
                    {!! Form::label('invoice_cap', 'Cap*', ['class' => 'control-label']) !!}
                    {!! Form::text('invoice_cap', old('Cap'), ['class' => 'form-control', 'placeholder' => 'Inserisci Cap', 'required' => '']) !!}
                </div>

                <div class="col-xs-3 form-group">
                    {!! Form::label('invoice_city', 'Citt&agrave;*', ['class' => 'control-label']) !!}
                    {!! Form::text('invoice_city', old('Citt&agrave;'), ['class' => 'form-control', 'placeholder' => 'Inserisci Citt&agrave;', 'required' => '']) !!}
                </div>

                <div class="col-xs-3 form-group">
                    {!! Form::label('invoice_country', 'Nazione*', ['class' => 'control-label']) !!}
                    {{ Form::select ('invoicecountry', $countries, $lab->invoice_country , ['class' => 'form-control','id' =>'invoicecountry']) }}
                </div>

                <div class="col-xs-3 form-group">
                    {!! Form::label('participation_fee', 'Participation fee*', ['class' => 'control-label']) !!}
                    {!! Form::text('participation_fee', old('Participation fee'), ['class' => 'form-control', 'placeholder' => 'Inserisci Participation fee', 'required' => '']) !!}
                </div>

                <div class="col-xs-3 form-group">
                    {!! Form::label('shipment_cost', 'Shipment cost*', ['class' => 'control-label']) !!}
                    {!! Form::text('shipment_cost', old('Shipment cost'), ['class' => 'form-control', 'placeholder' => 'Inserisci Shipment cost', 'required' => '']) !!}
                </div>

                <div class="col-xs-3 form-group">
                    {!! Form::label('invoicetype', 'Tipologia di Fattura*', ['class' => 'control-label']) !!}
                    {{ Form::select ('invoicetype', ['IT' => 'ITALIA','UE' => 'UE', 'NOUE' => 'EXTRA UE'], $lab->invoicetype , ['class' => 'form-control','id' =>'tipologia']) }}

                </div>

                <div class="col-xs-12 form-group">
                    {!! Form::label('status', 'Status', ['class' => 'control-label']) !!}
                    {!! Form::checkbox('status', old('Status'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'value' => '0']) !!}
                </div>

            </fieldset>
        </div>
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-success']) !!}
    <a href="{{url('laboratorio')}}" class="btn btn-danger">{{trans('global.app_back_to_list')}}</a>
    {!! Form::close() !!}
@stop

