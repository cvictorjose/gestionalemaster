@extends('layouts.app')

<?php
$today = date("my");
?>

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
                    {!! Form::text('code_round',$today, ['class' => 'form-control', 'placeholder' => 'Inserisci il Code Round' ]) !!}
                </div>

                <div class="col-xs-12 form-group">
                    {!! Form::label('Lab', 'Laboratorio*', ['class' => 'control-label']) !!}
                    <select class="js-data-example-ajax" style="width: 100%" name="laboratory_id"></select>
                </div>

                <div class="col-xs-12 form-group">
                    <h4>{!! Form::label('Code', 'Data results received on time', ['class' => 'control-label']) !!}</h4>

                    <div class="col-xs-3 input-group">
                        <div class="btn-group btn-group-vertical" data-toggle="buttons">
                            <label class="btn active">
                                <input type="radio" name='results_received' checked><i class="fa fa-circle-o
                                fa-2x"></i><i
                                        class="fa fa-dot-circle-o fa-2x"></i> <span>  Si</span>
                            </label>
                            <label class="btn">
                                <input type="radio" name='results_received'><i class="fa fa-circle-o fa-2x"></i><i class="fa
                                fa-dot-circle-o fa-2x"></i><span> No</span>
                            </label>
                        </div>
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
                                        <div class="btn-group btn-group" data-toggle="buttons">
                                            <label class="btn active">
                                                <input type="checkbox" name='{{ $test->code }}' >
                                                <i class="fa fa-square-o fa-2x"></i>
                                                <i class="fa fa-check-square-o fa-2x"></i><span> {{ $test->code }}
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-vertical" data-toggle="buttons">
                                            <label class="btn ">
                                                <input type="radio" name='question1_{{ $test->code }}' value="1">
                                                <i class="fa fa-circle-o fa-2x"></i>
                                                <i class="fa fa-dot-circle-o fa-2x"></i>
                                                <span style="padding-right: 5px;">Si</span>
                                            </label>

                                            <label class="btn active">
                                                <input type="radio" name='question1_{{ $test->code }}' checked
                                                       value="0">
                                                <i class="fa fa-circle-o fa-2x"></i>
                                                <i class="fa fa-dot-circle-o fa-2x"></i> <span>No</span>
                                            </label>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="btn-group btn-group-vertical" data-toggle="buttons">
                                            <label class="btn ">
                                                <input type="radio" name='question2_{{ $test->code }}' value="1">
                                                <i class="fa fa-circle-o fa-2x"></i>
                                                <i class="fa fa-dot-circle-o fa-2x"></i>
                                                <span style="padding-right: 5px;">Si</span>
                                            </label>

                                            <label class="btn active ">
                                                <input type="radio" name='question2_{{ $test->code }}' checked
                                                       value="0">
                                                <i class="fa fa-circle-o fa-2x"></i>
                                                <i class="fa fa-dot-circle-o fa-2x"></i> <span>No</span>
                                            </label>
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

            {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </div>
    </div>
    </div>
@stop

