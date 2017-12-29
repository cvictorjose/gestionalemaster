@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>@lang('global.app_list')   @lang('global.labs.title')</h4>
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($labs) > 0 ? 'datatable' : '' }} dt-datatable">
                <thead>
                    <tr>
                        <th>ICAR Code</th>
                        <th>Laboratorio</th>
                        <th>Delivery Address</th>
                        <th>City</th>
                        <th>Country</th>
                        <th>Contact person</th>
                        <th>Email</th>
                        <th>Telephone</th>

                        <th>Fat_ref</th>
                        <th>Protein_ref</th>
                        <th>Lactose_ref</th>
                        <th>Urea_ref</th>
                        <th>Scc_ref</th>
                        <th>Fat_rout</th>
                        <th>Protein_rout</th>
                        <th>Lactose_rout</th>
                        <th>Urea_rout</th>
                        <th>BHB</th>
                        <th>PAG</th>
                        <th>DNA</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($labs) > 0)
                        @foreach ($labs as $lab)
                            <tr data-entry-id="{{ $lab->id }}">
                                <td>{{ $lab->icar_code }}</td>
                                <td>{{ $lab->lab_name }}</td>

                                <td>{{ $lab->invoice_address }}</td>
                                <td>{{ $lab->invoice_city }}</td>
                                <td>{{ $lab->invoice_country }}</td>
                                <td>{{ $lab->contatto_amministrativo }}</td>
                                <td>{{ $lab->email }}</td>
                                <td></td>
                                <td>{{ (isset($lab->fat_ref))?1:0 }}</td>
                                <td>{{ (isset($lab->protein_ref))?1:0 }}</td>
                                <td>{{ (isset($lab->lactose_ref))?1:0 }}</td>
                                <td>{{ (isset($lab->urea_ref))?1:0 }}</td>
                                <td>{{ (isset($lab->scc_ref))?1:0 }}</td>
                                <td>{{ (isset($lab->fat_rout))?1:0 }}</td>
                                <td>{{ (isset($lab->protein_rout))?1:0 }}</td>
                                <td>{{ (isset($lab->lactose_rout))?1:0 }}</td>
                                <td>{{ (isset($lab->urea_rout))?1:0 }}</td>
                                <td>{{ (isset($lab->bhb))?1:0 }}</td>
                                <td>{{ (isset($lab->pag))?1:0 }}</td>
                                <td>{{ (isset($lab->dna))?1:0 }}</td>

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
