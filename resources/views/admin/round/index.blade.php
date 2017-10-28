@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <a href="{{ route('round.create') }}" class="btn btn-success pull-right">@lang('global.app_add_new')</a>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>@lang('global.app_list')   @lang('global.round.title')</h4>
        </div>


        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped datatable">
                <thead>
                    <tr>
                        <th>Codice Round</th>
                        <th>Numero Laboratori</th>
                        <th>Azione</th>
                    </tr>
                </thead>
                <tbody>
                @if (count($rounds) > 0)
                    @foreach ($rounds as $round)
                        <tr data-entry-id="{{ $round->id }}">
                            <td>{{ $round->code_round }}</td>
                            <td>{{ $total_labs}}</td>
                            <td>
                                <a href="{{ route('round_labs') }}" class="btn btn-xs btn-info">@lang('global.labs.det_labs')</a>
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


