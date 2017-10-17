@extends('layouts.app')

@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['round.store']]) !!}
    {{ Form::hidden('idLab', 'secret', array('id' => 'invisible_id')) }}
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>

        <div class="panel-body">
            <div class="panel panel-primary">
                <div class="panel-heading">Example of Bootstrap Typeahead Autocomplete Search Textbox</div>
                <div class="panel-body">
                    <div class="col-xs-3 form-group">

                        {!! Form::label('Code', 'Codice Round*', ['class' => 'control-label']) !!}
                        {!! Form::text('code_round', old('Laboratorio'), ['class' => 'form-control', 'placeholder' => 'Inserisci il Code Round']) !!}


                    </div>

                    <div class="col-xs-12 form-group">
                        {!! Form::label('Lab', 'Laboratorio*', ['class' => 'control-label']) !!}
                        {!! Form::text('search_text', null, array('placeholder' => 'Search Text','class' => 'form-control','id'=>'search_text')) !!}

                    </div>


                    <div class="col-xs-12 form-group">
                        {!! Form::label('Code', 'esta es la prima domanda', ['class' => 'control-label']) !!}
                        <div class="col-xs-3 input-group">
                            <span class="input-group-addon">
                              <input type="radio"  id="domanda1" name="domanda1">
                            </span>
                            {!! Form::label('Code', 'Domanda 1', ['class' => 'form-control']) !!}
                        </div>

                        <div class="col-xs-3 input-group">
                            <span class="input-group-addon">
                              <input type="radio" id="domanda1" name="domanda1">
                            </span>
                            {!! Form::label('Code', 'Domanda 2', ['class' => 'form-control']) !!}
                        </div>
                    </div>


                    <div class="col-xs-12 form-group">
                        {!! Form::label('Code', 'TEST', ['class' => 'control-label']) !!}

                        @if (count($tests) > 0)
                            @foreach ($tests as $test)
                                <div class="col-xs-3 input-group">
                                    <span class="input-group-addon">
                                      <input type="checkbox"  id="{{ $test->code }}" name="{{ $test->code }}">
                                    </span>
                                    {!! Form::label('Code', $test->code, ['class' => 'form-control']) !!}
                                </div>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9">@lang('global.app_no_entries_in_table')</td>
                            </tr>
                        @endif



                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

