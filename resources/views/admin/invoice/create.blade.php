@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')
@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['invoice.store']]) !!}
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>@lang('global.app_invoice')</h4>
        </div>

        <div class="panel-body table-responsive">
            <div class="col-xs-8 form-group">
                {!! Form::label('Lab', 'Laboratorio*', ['class' => 'control-label']) !!}
                <select class="js-data-example-ajax" style="width: 100%" name="laboratory_id"></select>
            </div>

            <div class="col-xs-2 form-group">
                {!! Form::label('invoice_no', 'Invoice No.*', ['class' => 'control-label']) !!}
                {!! Form::text('invoice_no',"", ['class' => 'form-control', 'placeholder' => 'Invoice No.' ]) !!}
            </div>

            <div class="col-xs-2 form-group">
                {!! Form::label('date', 'Date*', ['class' => 'control-label']) !!}
                {!!  Form::date('date', \Carbon\Carbon::now(), ['class' => 'control-label']) !!}
            </div>

            <div class="col-xs-12 form-group">
                {!! Form::label('activities', 'Activities*', ['class' => 'control-label']) !!}
                {!! Form::textarea('activities',"", ['class' => 'form-control' ]) !!}
            </div>
        </div>
        {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-success']) !!}
        {!! Form::close() !!}
    </div>
@stop
