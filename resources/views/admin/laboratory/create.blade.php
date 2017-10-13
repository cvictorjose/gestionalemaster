@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.labs.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['laboratorio.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>


        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">


                    {!! Form::label('lab_name', 'Laboratorio*', ['class' => 'control-label']) !!}
                    {!! Form::text('lab_name', old('Laboratorio'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('lab_name'))
                        <p class="help-block">
                            {{ $errors->first('lab_name') }}
                        </p>
                    @endif
                </div>

                <div class="col-xs-12 form-group">
                    {!! Form::label('icar_code', 'Codice Laboratorio*', ['class' => 'control-label']) !!}
                    {!! Form::text('icar_code', old('Codice Laboratorio'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('icar_code'))
                        <p class="help-block">
                            {{ $errors->first('icar_code') }}
                        </p>
                    @endif
                </div>

                <div class="col-xs-12 form-group">
                    {!! Form::label('status', 'Status', ['class' => 'control-label']) !!}
                    {!! Form::checkbox('status', old('Status'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'value' => '0']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('status'))
                        <p class="help-block">
                            {{ $errors->first('status') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

