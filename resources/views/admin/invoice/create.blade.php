@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')
@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['invoice.store']]) !!}
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>@lang('global.app_invoice')</h4>
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('Lab', 'Laboratorio*', ['class' => 'control-label']) !!}
                <select class="js-data-example-ajax" style="width: 100%" name="laboratory_id"></select>
            </div>

            <div class="col-xs-3 form-group">
                {!! Form::label('Round', 'Round*', ['class' => 'control-label']) !!}
                <select class="form-control"  id="itemselect" name="itemselect"><option>Scegli un Round</option></select>
            </div>

            <div class="col-xs-3 form-group">
                {!! Form::label('invoice_no', 'Invoice No.*', ['class' => 'control-label']) !!}
                {!! Form::text('invoice_no',"", ['class' => 'form-control', 'placeholder' => 'Invoice No.' ]) !!}
            </div>

            <div class="col-xs-6 form-group">
                {!! Form::label('date', 'Date*', ['class' => 'control-label']) !!}
                {!!  Form::date('date', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
            </div>

            <div class="col-xs-12 form-group">
                {!! Form::label('activities', 'Activities*', ['class' => 'control-label']) !!}
                {!! Form::textarea('activities',"", ['class' => 'form-control' ]) !!}
            </div>
            </div>
        </div>
        {!! Form::submit(trans('global.app_create_invoice'), ['class' => 'btn btn-success']) !!}
        {!! Form::close() !!}
    </div>
@stop
