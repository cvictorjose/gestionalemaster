@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
{!! Charts::scripts()  !!}
@foreach($codetest as $who)

    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fa fa-bar-chart-o"></i>
                    <h3 class="box-title">ZSCORE-PT - {{$who}}</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="app">
                        <center>
                            {!! $chart['zscorept'][$who]->html() !!}
                        </center>
                    </div>

                    {!! $chart['zscorept'][$who]->script() !!}
                </div>
            </div>
        </div>




    </div>
@endforeach
@stop
