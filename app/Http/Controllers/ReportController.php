<?php

namespace App\Http\Controllers;

use App\Data;
use App\Round;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function roundReport()
    {
        return view('admin.report.report');

        try {
            $inputData  = Input::all(); //echo "<pre>"; print_r($inputData); //exit;
            $icar_code=$inputData['icar_code'];
            $round=$inputData['lab_round'];
            $labs = Data::where('icar_code',$icar_code)->Where('round', $round)->get();

            return $dati;
        } catch (\Exception $e) {
            $message = [
                'flashType'    => 'danger',
                'flashMessage' => 'Errore! Laboratorio'
            ];
        }
        return view('admin.round.lab_test', compact('labs'));
    }
}
