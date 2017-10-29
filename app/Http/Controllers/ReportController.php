<?php

namespace App\Http\Controllers;

use App\Data;
use App\Laboratory;
use App\Outlier;
use App\Pag;
use App\Repeatability;
use App\Round;
use App\Zscorefix;
use App\Zscorept;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function roundReport()
    {
        try {
            $inputData  = Input::all(); //echo "<pre>"; print_r($inputData); //exit;
            $icar  = $inputData['icar'];
            $round = $inputData['round'];
            $lab_id =$inputData['lab_id'];

            //ZscorePT
            $zscorept=Zscorept::getZScorePt($icar,$round);

            //ZscoreFIX
            $zscorefix=Zscorefix::getZScoreFix($icar,$round);

            //REPEAT
            $arr_sp1=Repeatability::getRepeat($icar,$round);

            //OUTLIER
            $outlier=Outlier::getOutliers($icar,$round);
            //return $outlier;

            //PAG
            $pag=Pag::getPag("11",'RT0317');

            $data  = Data::where('icar_code',$icar)->Where('round', $round)->get();
            $round = Round::where('laboratory_id',$lab_id)->Where('code_round', $round)->get();
            $lab   = Laboratory::find($lab_id);
            return view('admin.report.report', compact('data','round','lab','outlier','arr_sp1','zscorept','zscorefix','pag'));

        } catch (\Exception $e) {
            $message = [
                'flashType'    => 'danger',
                'flashMessage' => 'Errore! Laboratorio'
            ];
        }
    }

    public function grafico()
    {
        return view('admin.grafico.index');

    }
}
