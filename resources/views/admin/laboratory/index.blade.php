@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    {{--<h3 class="page-title">@lang('global.labs.title')</h3>--}}
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
            <a href="{{ route('laboratorio.create') }}" class="btn btn-success">
                @lang('global.app_add_new')</a>
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($labs) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>

                        {{--<th>@lang('global.users.fields.name')</th>
                        <th>@lang('global.users.fields.email')</th>
                        <th>@lang('global.users.fields.roles')</th>
                        <th>&nbsp;</th>--}}

                        <th>ID</th>
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

                                <td></td>

                                <td>{{ $lab->id  }}</td>
                                <td>{{ $lab->icar_code }}</td>
                                <td><a href="{{ url('/laboratorio', $lab->id) }}">{{ $lab->lab_name }}</a></td>
                                <td>{{ ($lab->status > 0) ? 'activo' : 'disattivato' }}</td>
                                <td>{{ $lab->created_at }}</td>
                                <td>
                                    <a href="{{ route('admin.users.edit',[$lab->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
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

@section('javascript') 
    <script>
        window.route_mass_crud_entries_destroy = '{{ route('admin.users.mass_destroy') }}';
    </script>
@endsection