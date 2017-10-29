@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <a href="{{ route('laboratorio.create') }}" class="btn btn-success pull-right">@lang('global.app_add_new')</a>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>@lang('global.app_list')   @lang('global.labs.title')</h4>
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($labs) > 0 ? 'datatable' : '' }} dt-datatable">
                <thead>
                    <tr>
                        {{--<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>--}}
                        {{--<th>@lang('global.users.fields.name')</th>
                        <th>@lang('global.users.fields.email')</th>
                        <th>@lang('global.users.fields.roles')</th>
                        <th>&nbsp;</th>--}}

                        {{--<th>ID</th>--}}
                        <th>Code</th>
                        <th>Laboratorio</th>
                        <th>Status</th>
                        <th>Registrato</th>
                        <th>Azione</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($labs) > 0)
                        @foreach ($labs as $lab)
                            <tr data-entry-id="{{ $lab->id }}">
                                {{--<td></td>--}}
                                {{--<td>{{ $lab->id  }}</td>--}}
                                <td>{{ $lab->icar_code }}</td>
                                <td>{{ $lab->lab_name }}</td>
                                <td>{{ ($lab->status > 0) ? 'activo' : 'disattivato' }}</td>
                                <td>{{ $lab->created_at }}</td>
                                <td>
                                    <a href="{{ route('laboratorio.edit',[$lab->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['laboratorio.destroy', $lab->id])) !!}
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

{{--
@section('javascript')
    <script>
        window.route_mass_crud_entries_destroy = '{{ url('laboratorio.massDestroy') }}';
    </script>
@endsection--}}
