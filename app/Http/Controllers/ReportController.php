<?php

namespace App\Http\Controllers;

use App\Data;
use App\Laboratory;
use App\Means;
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
     * Create report Reference belong to a Lab.
     *
     * @return \Illuminate\Http\Response
     */
    public function roundReportRef()
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
            return view('admin.report.report_ref', compact('data','round','lab','outlier','arr_sp1','zscorept',
                'zscorefix','pag'));

        } catch (\Exception $e) {
            $message = [
                'flashType'    => 'danger',
                'flashMessage' => 'Errore! Laboratorio'
            ];
        }
    }

    /**
     * Create report Routine belong to a Lab.
     *
     * @return \Illuminate\Http\Response
     */
    public function roundReportRot()
    {
        try {
            $inputData  = Input::all(); //echo "<pre>"; print_r($inputData); //exit;
            $icar  = $inputData['icar'];
            $round = $inputData['round'];
            $lab_id =$inputData['lab_id'];

            //ZscorePT
            $zscorept=Zscorept::getZScorePtRot($icar,$round);

            //ZscoreFIX
            $zscorefix=Zscorefix::getZScoreFixRot($icar,$round);

            //REPEAT
            $arr_sp1=Repeatability::getRepeatRot($icar,$round);

            //OUTLIER
            $outlier=Outlier::getOutliersRot($icar,$round);
            //return $outlier;

            //PAG
            $pag=Pag::getPag("11",'RT0317');

            $data  = Data::where('icar_code',$icar)->Where('round', $round)->get();


            $round = Round::where('laboratory_id',$lab_id)->Where('code_round', $round)->get();
            $lab   = Laboratory::find($lab_id);
            return view('admin.report.report_rot', compact('data','round','lab','outlier','arr_sp1','zscorept',
                'zscorefix','pag'));

        } catch (\Exception $e) {
            $message = [
                'flashType'    => 'danger',
                'flashMessage' => 'Errore! Laboratorio'
            ];
        }
    }


    /**
     * Create Chart ZscorePt vs ZscoreFx belong to a Lab.
     *
     * @return \Illuminate\Http\Response
     */
    public function grafico()
    {
        /*$icar="1";
        $round="RF0316";*/

        $inputData  = Input::all(); //echo "<pre>"; print_r($inputData); //exit;
        $icar  = $inputData['icar'];
        $round = $inputData['round'];

        $dataCurrentRound=Means::getDataCurrentRound($icar,$round);

        if (!$dataCurrentRound){
            return response()->view('errors.custom', ['code' => 404, 'error' => trans('error.NOT_RESULTS_DB')],
                404);
        }


        $ordinamento_sample=$dataCurrentRound['positions'];

        //return $dataCurrentRound;
        //return $dataCurrentRound['currentRound']['base'];
        //return  $dataCurrentRound['rounds'];
        //return $dataCurrentRound['currentRound']['fat_ref']['base'];


        //creo un chart array[test]
        $chart=array();
        $block2=$block3=$block2fx=$block3fx=$this->resetRound();
        $round2=$round3="n/a";

        $code_arr=array('fat_ref','protein_ref','lactose_ref','urea_ref','scc_ref','bhb');
        foreach ($code_arr as $type) {
            $p=1;
            $base=$dataCurrentRound['currentRound']['zscorept'][$type]['base'];
            $basefx=$dataCurrentRound['currentRound']['zscorefix'][$type]['base'];

            if (count($dataCurrentRound['rounds']>0)){

                foreach($dataCurrentRound['rounds'] as $r)
                {
                    switch ($p) {
                        case 1:
                            if ($dataCurrentRound['currentRound']['zscorept'][$type][$r]){
                                $block2 = $dataCurrentRound['currentRound']['zscorept'][$type][$r];
                            }

                            if ($dataCurrentRound['currentRound']['zscorefix'][$type][$r]){
                                $block2fx = $dataCurrentRound['currentRound']['zscorefix'][$type][$r];
                            }

                            $round2=$r;
                            break;
                        case 2:

                            if ($dataCurrentRound['currentRound']['zscorept'][$type][$r]){
                                $block3 = $dataCurrentRound['currentRound']['zscorept'][$type][$r];
                            }

                            if ($dataCurrentRound['currentRound']['zscorefix'][$type][$r]){
                                $block3fx = $dataCurrentRound['currentRound']['zscorefix'][$type][$r];
                            }

                            $round3=$r;
                            break;
                    }
                    $p++;
                }
            }


            $chart['zscorept'][$type]=$this->createChart($base,$block2,$block3,$round,$round2,$round3,
                $ordinamento_sample);

            $chartfx['zscorefix'][$type]=$this->createChart($basefx,$block2fx,$block3fx,$round,$round2,$round3,
                $ordinamento_sample);
        }
        return view('admin.grafico.index', ['chart' => $chart,'chartfx' => $chartfx]);
    }



    /**
     * Create Chart with 3 blocks data
     *
     * @return \Illuminate\Http\Response
     */
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


    /**
     * Return a block empty
     *
     * @return \Illuminate\Http\Response
     */
    public function resetRound()
    {
        $block= array(0,0,0,0,0,0,0,0,0,0);
        return $block;
    }




    //BackUP
    /*public function roundReportRef()
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
    }*/
}