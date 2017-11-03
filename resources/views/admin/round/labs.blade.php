@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')

    <a href="{{ route('round.index') }}" class="btn btn-danger pull-right">@lang('global.app_back_to_list')</a>
    <a href="{{ route('round.create') }}" class="btn btn-success pull-right">@lang('global.app_add_new')</a>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>@lang('global.app_list')  @lang('global.labs.title') @lang('global.round.title') </h4>
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped datatable">
                <thead>
                    <tr>
                        <th>Codice Round</th>
                        <th>Laboratorio</th>
                        <th><i class="fa fa-line-chart"></i> Grafico</th>
                        <th>Report</th>
                        <th>Azione</th>
                    </tr>
                </thead>
                <tbody>
                @if (count($labs) > 0)
                    @foreach ($labs as $lab)
                        <tr data-entry-id="{{ $lab->laboratory_id }}">
                            <td>{{ $lab->code_round }}</td>
                            <td>{{ $lab->lab_name }}</td>

                            <td>
                                <?php
                                $url = action('ReportController@reportPdfRef', ['lab_id' => $lab->laboratory_id,
                                'icar_code' => $lab->icar_code,'code_round' => $lab->code_round])
                                ?>
                                <a href="{{ $url }}" target="_blank">REF - Report/Grafico</a>
                            </td>
                            <td>
                                {{--REF REPORT BUTTON--}}
                                {!! Form::open(array(
                                       'style' => 'display: inline-block;',
                                       'method' => 'POST',
                                       'route' => ['round_report_ref'])) !!}
                                {{ csrf_field() }}
                                <input name="lab_id" type="hidden" value={{ $lab->laboratory_id }}>
                                <input name="icar" type="hidden" value={{ $lab->icar_code }}>
                                <input name="round" type="hidden" value={{ $lab->code_round }}>
                                {!! Form::submit(trans('global.report.ref'), array('class' => 'btn btn-xs btn-success')) !!}
                                {!! Form::close() !!}

                                {{--ROT REPORT BUTTON--}}
                                {!! Form::open(array(
                                       'style' => 'display: inline-block;',
                                       'method' => 'POST',
                                       'route' => ['round_report_rot'])) !!}
                                {{ csrf_field() }}
                                <input name="lab_id" type="hidden" value={{ $lab->laboratory_id }}>
                                <input name="icar" type="hidden" value={{ $lab->icar_code }}>
                                <input name="round" type="hidden" value={{ $lab->code_round }}>
                                {!! Form::submit(trans('global.report.rot'), array('class' => 'btn btn-xs
                                btn-success')) !!}
                                {!! Form::close() !!}

                            </td>
                            <td>
                                {{--details test--}}
                                {!! Form::open(array(
                                       'style' => 'display: inline-block;',
                                       'method' => 'POST',
                                       'route' => ['round_lab_test'])) !!}
                                {{ csrf_field() }}
                                <input name="lab_id" type="hidden" value={{$lab->laboratory_id}}>
                                <input name="lab_round" type="hidden" value={{$lab->code_round}}>
                                {!! Form::submit(trans('global.app_view'), array('class' => 'btn btn-xs btn-info')) !!}
                                {!! Form::close() !!}

                                {{--delete laboratorio--}}
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
            {{--<a href="{{url('laboratorio')}}" class="btn btn-danger pull-right">{{trans('global.app_back_to_list')}}</a>--}}
        </div>
    </div>
@stop


