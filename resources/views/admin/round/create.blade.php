@extends('layouts.app')
<?php $today = date("my");?>
@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['round.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>@lang('global.app_create') Round</h4>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('Code', 'Codice Round*', ['class' => 'control-label']) !!}
                    {!! Form::text('code_round',"", ['class' => 'form-control', 'placeholder' => 'Code Round' ]) !!}
                </div>

                <div class="col-xs-10 form-group">
                    {!! Form::label('Lab', 'Laboratorio*', ['class' => 'control-label']) !!}
                    <select class="js-data-example-ajax" style="width: 100%" name="laboratory_id"></select>
                </div>

                <div class="col-xs-12 form-group">
                    <h4>{!! Form::label('Code', 'Data results', ['class' => 'control-label']) !!}</h4>

                    <div class="col-xs-2 ">
                        <label>Ricevuti in tempo?</label>
                        <div class="btn-group btn-group-vertical" data-toggle="buttons">
                            <div class="input-group">
                                <div id="radioBtn" class="btn-group">
                                    <a class="btn btn-primary btn-sm notActive" data-toggle="happy0"
                                       data-title="1">YES</a>
                                    <a class="btn btn-primary btn-sm active" data-toggle="happy0"
                                       data-title="0">NO</a>
                                </div>
                                <input type="hidden" name="results_received" id="happy0" value="0">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-2 input-group">
                        <label>Quando?</label>
                        <input class="date form-control" type="text" name="date" size="20" placeholder="Scegli la data">
                    </div>
                </div>


                <div class="col-xs-12 form-group">
                    <h4>{!! Form::label('Code', 'Scegli i test', ['class' => 'control-label']) !!}</h4>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="col-xs-4">Descrizione del Test</th>
                            <th>Are all the sample results received?</th>
                            <th>Have you sent the data with the correct units of measurements?</th>
                        </tr>
                        </thead>

                        <tbody>
                        @if (count($tests) > 0)
                            @foreach ($tests as $test)
                                <tr data-entry-id="{{ $test->id }}">
                                    <td>
                                        <div class="funkyradio-default">
                                            <input type="checkbox" name="{{ $test->code }}" id="{{ $test->code }}" />
                                            <label for="checkbox1">{{strtoupper($test->code) }}</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-vertical" data-toggle="buttons">
                                            <div class="input-group">
                                                <div id="radioBtn" class="btn-group">
                                                    <a class="btn btn-primary btn-sm active"
                                                        data-toggle="happy_{{ $test->code }}"
                                                       data-title="1" >YES</a>
                                                    <a class="btn btn-primary btn-sm notActive" data-toggle="happy_{{ $test->code }}"
                                                       data-title="0">NO</a>
                                                </div>
                                                <input type="hidden" name="question1_{{ $test->code }}" id="happy_{{
                                                $test->code }}" value="1">
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="btn-group btn-group-vertical" data-toggle="buttons">
                                            <div class="input-group">
                                                <div id="radioBtn" class="btn-group">
                                                    <a class="btn btn-primary btn-sm active" data-toggle="happy2_{{
                                                    $test->code }}"
                                                       data-title="1">YES</a>
                                                    <a class="btn btn-primary btn-sm notActive"
                                                       data-toggle="happy2_{{ $test->code }}"
                                                       data-title="0">NO</a>
                                                </div>
                                                <input type="hidden" name="question2_{{ $test->code }}" id="happy2_{{
                                                $test->code }}" value="1">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9">@lang('global.app_no_entries_in_table')</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-success']) !!}
            {!! link_to(URL::previous(), trans('global.app_back_to_list'), ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </div>
    </div>
    </div>
@stop

