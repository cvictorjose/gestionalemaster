@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    {{--<h3 class="page-title">@lang('global.labs.title')</h3>--}}
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
            <a href="{{ route('round.create') }}" class="btn btn-success">
                @lang('global.app_add_new')</a>
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
                                <a href="{{ route('round_lab_test') }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>

                                {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['round_destroy'])) !!}
                                {{ csrf_field() }}

                                <input name="lab_id" type="hidden" value={{$lab->laboratory_id}}>
                                <input name="lab_round" type="hidden" value={{$lab->code_round}}>
                                {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                {!! Form::close() !!}

                                {{--<a href="{{ route('round.report',[$lab->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>--}}
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


