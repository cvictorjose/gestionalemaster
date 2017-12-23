@extends('layouts.app')

@section('content')
    {!! Form::model($tests, ['method' => 'post', 'route' => ['update_price']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Aggiornamento Prezzo/Test</h4>
        </div>

        <div class="panel-body">
            @if (count($tests) > 0)
                @foreach ($tests as $test)
                    <div class="col-xs-2 form-group">
                        {!! Form::label($test->code, strtoupper($test->code), ['class' => 'control-label']) !!}
                        <input type="text" name={{$test->code}} value={{$test->price}} class="form-control">
                    </div>
                @endforeach
            @endif
        </div>
    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-success']) !!}
    {!! Form::close() !!}
    </div>
@stop

