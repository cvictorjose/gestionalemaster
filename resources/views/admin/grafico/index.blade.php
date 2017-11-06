@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')



    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fa fa-bar-chart-o"></i>
                    <h3 class="box-title">ZSCORE-PT - fat_ref</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="app">
                        <center>
                            {!! $chart['zscorept']['fat_ref']->html() !!}
                        </center>
                    </div>
                    {!! Charts::scripts() !!}
                    {!! $chart['zscorept']['fat_ref']->script() !!}
                </div>
            </div>
        </div>


    </div>

@stop
