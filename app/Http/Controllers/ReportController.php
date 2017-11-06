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
     * Create Chart ZscorePt vs ZscoreFx belong to a Lab.
     *
     * @return \Illuminate\Http\Response
     */
    public function graficoReport($lab_id,$round,$type)
    {
        $dataCurrentRound=Means::getDataCurrentRound($lab_id,$round,$type);
        //return $dataCurrentRound;

        if (!$dataCurrentRound){
            return response()->view('errors.custom', ['code' => 404, 'error' => "MEANS EMPTY"],404);

        }
        $ordinamento_sample=$dataCurrentRound['positions'];
        //return $dataCurrentRound['currentRound']['base'];
        //return  $dataCurrentRound['rounds'];
        //return $dataCurrentRound['currentRound']['fat_ref']['base'];


        //creo un chart array[test]
        $chart=array();
        $block2=$block3=$block2fx=$block3fx=$this->resetRound();
        $round2=$round3="n/a";

        //array di codeTest attivati
        $code_arr=$dataCurrentRound['codetest'];

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

        $chart= array('chart' => $chart,'chartfx' => $chartfx, 'codetest'=>$code_arr);
        return $chart;
        //return view('admin.grafico.index', ['chart' => $chart,'chartfx' => $chartfx, 'codetest'=>$code_arr]);
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

    /**
     * Create report Reference belong to a Lab.
     *
     * @return \Illuminate\Http\Response
     */
    public function roundReportRef(Request $request)
    {
        try {
            /*$inputData  = Input::all(); //echo "<pre>"; print_r($inputData); //exit;
            $icar  = $inputData['icar'];
            $round = $inputData['round'];
            $lab_id =$inputData['lab_id'];*/

            $icar  = request()->icar_code;
            $round = request()->code_round;
            $lab_id =request()->lab_id;
            $type =request()->type;

            $code_arr= Round::checkTestAttivate($lab_id,$round,$type);
            if (empty($code_arr))return response()->view('errors.custom', ['code' => 404, 'error' => "NON CI SONO TEST ATTIVATI"],404);

            //DATA
            $datas= Data::getData($icar,$round,$code_arr);

            //Array composto di LabCode con CodeTest = Blocco A participation code
            $data2=$datas['d2'];
            //return $data2;
            if (empty($data2))return response()->view('errors.custom', ['code' => 404, 'error' => "DATA EMPTY"],404);

            //OUTLIER
            if ($type=="ref"){
                $outlier=Outlier::getOutliers($data2,$round);
            }else{
                $outlier=Outlier::getOutliersRot($data2,$round);
            }
            //return $outlier;
            //if (empty($outlier))return response()->view('errors.custom', ['code' => 404, 'error' => "OUTLIER $type
            //EMPTY"],404);


            //REPEAT
            $repeat=Repeatability::getRepeat($data2,$round);
            //return $repeat;

            //ZscorePT
            $zscorept=Zscorept::getZScorePt($data2,$round);
            //return $zscorept;

             //ZscoreFIX
            $zscorefix=Zscorefix::getZScoreFix($data2,$round);
            //return $zscorefix;


            //PAG
            if ($type=="rot"){
                //$icar="2";
                $pag=Pag::getPag($icar,$round);

            }

            /*$grafico   = $this->graficoReport($lab_id,$round,$type);
            //return $grafico;
            if (empty($grafico))return response()->view('errors.custom', ['code' => 404, 'error' => "CHART EMPTY"],404);
            $chart     = $grafico['chart'];
            $chartfx   = $grafico['chartfx'];*/


            $round = Round::where('laboratory_id',$lab_id)->Where('code_round', $round)->get();
            $lab   = Laboratory::find($lab_id);
            $data  = $datas['d'];

            if ($type=="ref"){
                //return view('admin.report.pdf_ref', compact('data','round','lab','outlier','repeat','zscorept','zscorefix','chart','chartfx','code_arr'));
                return view('admin.report.pdf_ref', compact('data','round','lab','outlier','repeat','zscorept','zscorefix'));
            }else{
                //return view('admin.report.pdf_rot', compact('data','round','lab','outlier','repeat','zscorept',
                // 'zscorefix','pag','chart','chartfx','code_arr'));
                return view('admin.report.pdf_rot', compact('data','round','lab','outlier','repeat','zscorept',
                    'zscorefix','pag'));
            }

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

        $lab_id="12";
        $round="RF0917";
        $dataCurrentRound=Means::getDataCurrentRound($lab_id,$round);
        //return $dataCurrentRound;

        if (!$dataCurrentRound){
            return response()->view('errors.custom', ['code' => 404, 'error' => trans('error.NOT_RESULTS_DB')],404);
        }
        $ordinamento_sample=$dataCurrentRound['positions'];


        //return $dataCurrentRound['currentRound']['base'];
        //return  $dataCurrentRound['rounds'];
        //return $dataCurrentRound['currentRound']['fat_ref']['base'];


        //creo un chart array[test]
        $chart=array();
        $block2=$block3=$block2fx=$block3fx=$this->resetRound();
        $round2=$round3="n/a";

        //array di codeTest attivati
        $code_arr=$dataCurrentRound['codetest'];

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

        // $chart= array('chart' => $chart,'chartfx' => $chartfx, 'codetest'=>$code_arr);

        // return $chart;
        return view('admin.grafico.index', ['chart' => $chart,'chartfx' => $chartfx, 'codetest'=>$code_arr]);
    }

}