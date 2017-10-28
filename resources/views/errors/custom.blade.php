@extends('layouts.apperror')

@section('content')
    <div class="container">

            <div class="col-md-11">
                <div class="panel panel-default">
                    <div class="panel-danger">
                        <div style="padding-left: 40px;">
                            <h2 class="headline text-yellow"> {{$error}}</h2>

                                <h3><i class="fa fa-warning text-yellow"></i> Oops! We have a Problem - Code:
                                    {{$code}}</h3>
                                <p>
                                    Non abbiamo trovato la pagina che stavi cercando. Nel frattempo, puoi tornare sul
                                    cruscotto <a href="/laboratorio">Laboratorio</a>.
                                </p>

                        </div>
                    </div>
                </div>
            </div>

    </div>
@endsection
