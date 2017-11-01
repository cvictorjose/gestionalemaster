@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')

    {{--<a href="{{ route('round.create') }}" class="btn btn-success pull-right">@lang('global.app_add_new')</a>--}}
    <div class="panel panel-default">
        <div class="panel-heading">

            <h4>@lang('global.app_list')  dei Test </h4>
            {!! Form::open(array(
               'style' => 'display: inline-block;',
               'method' => 'POST',
               'route' => ['round_labs'])) !!}
            {{ csrf_field() }}
            <input name="round_id" type="hidden" value={{$lab_round}}>

            {!! Form::submit(trans('global.app_back_to_list'), array('class' => 'btn btn-xs btn-danger')) !!}
            {!! Form::close() !!}
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped datatable">
                <thead>
                    <tr>
                        <th>Codice Round</th>
                        <th>Code Test</th>
                        <th>Sample results received?</th>
                        <th>Correct units of measurements?</th>
                        <th>Registrato?</th>
                        <th>Azione</th>
                    </tr>
                </thead>
                <tbody>
                @if (count($labs) > 0)
                    @foreach ($labs as $lab)

                        <tr data-entry-id="{{ $lab->id }}">
                            <td>{{ $lab->code_round }}</td>
                            <td>{{ $lab->code_test }}</td>
                            <td>{{ $lab->question1 }}</td>
                            <td>{{ $lab->question2 }}</td>
                            <td>{{ $lab->created_at }}</td>

                            <td>
                                {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['round_destroy_test'])) !!}
                                {{ csrf_field() }}

                                <input name="id" type="hidden" value={{$lab->id}}>
                                {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                {!! Form::close() !!}
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
@stop


