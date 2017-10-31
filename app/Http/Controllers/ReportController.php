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
        $dataCurrentRound=Repeatability::getDataCurrentRound($icar,$round);
        $ordinamento_sample=$dataCurrentRound['positions'];

        //return $dataCurrentRound['currentRound'];
        //return $dataCurrentRound['currentRound']['base'];
        //return  $dataCurrentRound['rounds'];
        //return $dataCurrentRound['currentRound']['fat_ref']['base'];

        //count array
        //azzera block2,3
        $chart=array();

        //$code_arr=array('fat_ref','protein_ref','lactose_ref','urea_ref','scc_ref','bhb');
        $code_arr=array('fat_ref','protein_ref','lactose_ref','urea_ref','scc_ref','bhb');
        foreach ($code_arr as $type) {
            $p=1;
            $base=$dataCurrentRound['currentRound'][$type]['base'];

            foreach($dataCurrentRound['rounds'] as $r)
            {
                switch ($p) {
                    case 1:
                        $block2 = $dataCurrentRound['currentRound'][$type][$r];
                        $round2=$r;
                        break;
                    case 2:
                        $block3 = $dataCurrentRound['currentRound'][$type][$r];
                        $round3=$r;
                        break;
                }
                $p++;
            }

            $chart['zscorept'][$type]=$this->createChart($base,$block2,$block3,$round,$round2,$round3,
                $ordinamento_sample);
        }


        return view('admin.grafico.index', ['chart' => $chart]);
    }

    public function createChart($base,$block2,$block3,$round,$round2,$round3,$ordinamento_sample)
    {
        $chart = Charts::multi('line', 'material')
            // Setup the chart settings
            ->title("")
            // A dimension of 0 means it will take 100% of the space
            ->dimensions(0, 300) // Width x Height
            // This defines a preset of colors already done:)
            ->template("material")
            // You could always set them manually
            // ->colors(['#2196F3', '#F44336', '#FFC107'])
            // Setup the diferent datasets (this is a multi chart)
            ->dataset($round, $base)
            ->dataset($round2,$block2)
            ->dataset($round3, $block3)

            // Setup what the values mean
            ->labels($ordinamento_sample);

        return $chart;
    }
}