@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')

  <div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-bar-chart-o"></i>
                <h3 class="box-title">ZSCORE-PT - FAT_REF</h3>
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


  <div class="row">
      <div class="col-md-6">
          <div class="box box-primary">
              <div class="box-header with-border">
                  <i class="fa fa-bar-chart-o"></i>
                  <h3 class="box-title">ZSCORE-PT - PROTEIN</h3>
                  <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
              </div>
              <div class="box-body">
                  <div class="app">
                      <center>
                          {!! $chart['zscorept']['protein_ref']->html() !!}
                      </center>
                  </div>
                  {!! Charts::scripts() !!}
                  {!! $chart['zscorept']['protein_ref']->script() !!}
              </div>
          </div>
      </div>
  </div>



  <div class="row">
      <div class="col-md-6">
          <div class="box box-primary">
              <div class="box-header with-border">
                  <i class="fa fa-bar-chart-o"></i>
                  <h3 class="box-title">ZSCORE-PT - LAC</h3>
                  <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
              </div>
              <div class="box-body">
                  <div class="app">
                      <center>
                          {!! $chart['zscorept']['lactose_ref']->html() !!}
                      </center>
                  </div>
                  {!! Charts::scripts() !!}
                  {!! $chart['zscorept']['lactose_ref']->script() !!}
              </div>
          </div>
      </div>
  </div>



  <div class="row">
      <div class="col-md-6">
          <div class="box box-primary">
              <div class="box-header with-border">
                  <i class="fa fa-bar-chart-o"></i>
                  <h3 class="box-title">ZSCORE-PT - UREA</h3>
                  <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
              </div>
              <div class="box-body">
                  <div class="app">
                      <center>
                          {!! $chart['zscorept']['urea_ref']->html() !!}
                      </center>
                  </div>
                  {!! Charts::scripts() !!}
                  {!! $chart['zscorept']['urea_ref']->script() !!}
              </div>
          </div>
      </div>
  </div>


  <div class="row">
      <div class="col-md-6">
          <div class="box box-primary">
              <div class="box-header with-border">
                  <i class="fa fa-bar-chart-o"></i>
                  <h3 class="box-title">ZSCORE-PT - scc</h3>
                  <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
              </div>
              <div class="box-body">
                  <div class="app">
                      <center>
                          {!! $chart['zscorept']['scc_ref']->html() !!}
                      </center>
                  </div>
                  {!! Charts::scripts() !!}
                  {!! $chart['zscorept']['scc_ref']->script() !!}
              </div>
          </div>
      </div>
  </div>

  <div class="row">
      <div class="col-md-6">
          <div class="box box-primary">
              <div class="box-header with-border">
                  <i class="fa fa-bar-chart-o"></i>
                  <h3 class="box-title">ZSCORE-PT - bhb</h3>
                  <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
              </div>
              <div class="box-body">
                  <div class="app">
                      <center>
                          {!! $chart['zscorept']['bhb']->html() !!}
                      </center>
                  </div>
                  {!! Charts::scripts() !!}
                  {!! $chart['zscorept']['bhb']->script() !!}
              </div>
          </div>
      </div>
  </div>




@stop
