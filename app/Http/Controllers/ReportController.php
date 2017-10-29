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
use ConsoleTVs\Charts\Facades\Charts;
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
        $icar="1";
        $round="RF0316";
        $data_g=Repeatability::grafic_repeat($icar,$round);

return $data_g;

        $chart = Charts::multi('line', 'material')
            // Setup the chart settings
            ->title("FAT_REF")
            // A dimension of 0 means it will take 100% of the space
            ->dimensions(0, 400) // Width x Height
            // This defines a preset of colors already done:)
            ->template("material")
            // You could always set them manually
            // ->colors(['#2196F3', '#F44336', '#FFC107'])
            // Setup the diferent datasets (this is a multi chart)
            ->dataset($round, [5,20,100,15,30,80,15,30,80,22])
            ->dataset('0116', [15,30,80,25,10,40,25,10,40,44])
            ->dataset('1215', [25,10,40,15,30,80,15,30,80,22])
            // Setup what the values mean
            ->labels(['S1', 'S2', 'S3', 'S4', 'S5', 'S6', 'S7', 'S8', 'S9', 'S10']);

        return view('admin.grafico.index', ['chart' => $chart]);
    }
}