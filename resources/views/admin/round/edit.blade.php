@extends('layouts.app')

@section('content')
    {!! Form::model($lab, ['method' => 'PUT', 'route' => ['round.update', $lab->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit') - {{$lab->lab_name}}
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('lab_name', 'Laboratorio*', ['class' => 'control-label']) !!}
                    {!! Form::text('lab_name', old('Laboratorio'), ['class' => 'form-control', 'placeholder' => 'Inserisci il Nome']) !!}
                </div>

                <div class="col-xs-12 form-group">
                    {!! Form::label('icar_code', 'Codice Laboratorio*', ['class' => 'control-label']) !!}
                    {!! Form::text('icar_code', old('Codice Laboratorio'), ['class' => 'form-control', 'placeholder' => 'Inserisci il codice', 'required' => '']) !!}
                 </div>

                <div class="col-xs-12 form-group">
                    {!! Form::label('status', 'Status', ['class' => 'control-label']) !!}
                    {!! Form::checkbox('status', old('Status'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'value' => '0']) !!}
                </div>
            </div>
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-success']) !!}
    <a href="{{url('laboratorio')}}" class="btn btn-danger">{{trans('global.app_back_to_list')}}</a>
    {!! Form::close() !!}
@stop

