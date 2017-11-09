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
    public function graficoReport($lab_id,$round,$type,$icar)
    {
        $code_arr= Round::checkTestAttivate($lab_id,$round,$type);
        $dataCurrentRound=Means::getDataCurrentRound($round,$code_arr,$icar);
       // return $dataCurrentRound;

        if (!$dataCurrentRound){
            return response()->view('errors.custom', ['code' => 404, 'error' => trans('error.NOT_RESULTS_DB')],404);
        }
        //$ordinamento_sample=$dataCurrentRound['positions'];
        $block2=$block3=$block2fx=$block3fx=$this->resetRound();
        $round2=$round3="n/a";

        //array di codeTest attivati
        //$new_code_arr=$dataCurrentRound['codetest'];
        foreach ($code_arr as $type) {
            if ($type!="pag"){
                $base=$dataCurrentRound['currentRound']['zscorept'][$type]['base'];
                $basefx=$dataCurrentRound['currentRound']['zscorefix'][$type]['base'];

                $i=1;
                foreach ($dataCurrentRound['cr_before'] as $cr){
                    if($i==1){
                        $block2=$dataCurrentRound['currentRound']['zscorept'][$type][$cr->code_round];
                        $block2fx=$dataCurrentRound['currentRound']['zscorefix'][$type][$cr->code_round];
                        $i++;
                        $round2=$cr->code_round;
                    }else{
                        $block3=$dataCurrentRound['currentRound']['zscorept'][$type][$cr->code_round];
                        $block3fx=$dataCurrentRound['currentRound']['zscorefix'][$type][$cr->code_round];
                        $round3=$cr->code_round;
                    }
                }

                $chart['zscorept'][$type]=$this->createChart($base,$block2,$block3,$round,$round2,$round3);
                $chartfx['zscorefix'][$type]=$this->createChart($basefx,$block2fx,$block3fx,$round,$round2,$round3);
            }
        }
        $chart=array("chart"=>$chart, 'chartfx'=>$chartfx);
       return $chart;
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

            $data=$outlier=$repeat=$zscorept=$zscorefix=$chart=$chartfx=$code_arr=array();

            $code_arr= Round::checkTestAttivate($lab_id,$round,$type);
            if (!empty($code_arr)){
                //DATA
                $datas= Data::getData($icar,$round,$code_arr);
                //Array composto di LabCode con CodeTest = Blocco A participation code
                $data2 = $datas['d2'];
                $data  = $datas['d'];
                if (empty($data2))return response()->view('errors.custom', ['code' => 404, 'error' => "DATA EMPTY"],404);

                //OUTLIER
                $outlier=Outlier::getOutliers($data2,$round);
                //return $outlier;

                //REPEAT
                $repeat=Repeatability::getRepeat($data2,$round);
                //return $repeat;

                //ZscorePT
                $zscorept=Zscorept::getZScorePt($data2,$round);
                //return $zscorept;

                //ZscoreFIX
                $zscorefix=Zscorefix::getZScoreFix($data2,$round);
                //return $zscorefix;


                $grafico   = $this->graficoReport($lab_id,$round,$type,$icar);
                //return $grafico;
                if (empty($grafico))return response()->view('errors.custom', ['code' => 404, 'error' => "CHART EMPTY"],404);
                $chart     = $grafico['chart']['zscorept'];
                $chartfx   = $grafico['chartfx']['zscorefix'];
            }
            //PAG
            if ($type=="rot"){
                $pagx=Pag::getPag($icar,$round);
                //return $pagx;
            }


            $round = Round::where('laboratory_id',$lab_id)->Where('code_round', $round)->get();
            $lab   = Laboratory::find($lab_id);


            if ($type=="ref"){
                return view('admin.report.pdf_ref', compact('data','round','lab','outlier','repeat','zscorept',
                    'zscorefix','chart','chartfx','code_arr'));
            }else{
                return view('admin.report.pdf_rot', compact('data','round','lab','outlier','repeat','zscorept',
                    'zscorefix','pagx','chart','chartfx','code_arr','icar'));
            }

        } catch (\Exception $e) {
            $message = [
                'flashType'    => 'danger',
                'flashMessage' => 'Errore! Laboratorio'
            ];
        }
    }


    /**
     * Create Chart with 3 blocks data
     *
     * @return \Illuminate\Http\Response
     */
    public function createChart($base,$block2,$block3,$round,$round2,$round3)
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
            ->labels([1, 2, 3, 4, 5, 6, 7,8,9,10]);
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
     * Create Chart ZscorePt vs ZscoreFx belong to a Lab.
     *
     * @return \Illuminate\Http\Response
     */
    public function grafico()
    {

        $lab_id="12";
        $round="RF0917";
        $type="ref";

        $code_arr= Round::checkTestAttivate($lab_id,$round,$type);
        $dataCurrentRound=Means::getDataCurrentRound($lab_id,$round,$code_arr);
        //return $dataCurrentRound;

        if (!$dataCurrentRound){
            return response()->view('errors.custom', ['code' => 404, 'error' => trans('error.NOT_RESULTS_DB')],404);
        }

        //creo un chart array[test]
        $chart=array();
        $block2=$block3=$block2fx=$block3fx=$this->resetRound();
        $round2=$round3="n/a";

        //array di codeTest attivati
        $new_code_arr=$dataCurrentRound['codetest'];
        //return $new_code_arr;
        foreach ($new_code_arr as $type) {
            //$p=1;
            $base=$dataCurrentRound['currentRound']['zscorept'][$type]['base'];
            //$basefx=$dataCurrentRound['currentRound']['zscorefix'][$type]['base'];
            $chart['zscorept'][$type]=$this->createChart($base,$block2,$block3,$round,$round2,$round3);
            //$chartfx['zscorefix'][$type]=$this->createChart($basefx,$block2fx,$block3fx,$round,$round2,$round3);
        }
        return view('admin.grafico.index', ['chart' => $chart,'codetest'=>$new_code_arr]);
    }

}