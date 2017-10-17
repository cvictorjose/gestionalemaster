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

                {{--<div class="panel panel-primary">
                    <div class="panel-heading">Example of Bootstrap Typeahead Autocomplete Search Textbox</div>
                    <div class="panel-body">
                        <div class="form-group">
                            {!! Form::text('search_text', null, array('placeholder' => 'Search Text','class' => 'form-control','id'=>'search_text')) !!}
                        </div>
                    </div>
                 </div>--}}
        </div>
    </div>
@stop


