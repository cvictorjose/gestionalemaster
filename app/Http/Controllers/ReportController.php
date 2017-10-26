<?php

namespace App\Http\Controllers;

use App\Data;
use App\Laboratory;
use App\Outlier;
use App\Round;
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

            $sn_1=$sn_2=$sn_3=$sn_4=$sn_5=$sn_6=$sn_7=$sn_8=$sn_9=$sn_10=array();

            $outliers= Outlier::where('round','RF0316')->where('lab_code','1')->orderBy('sample_number')->get();

            foreach($outliers as $o)
            {
                $item= new \stdClass();
                $item->code  =$o->type;
                $item->outlier=$o->outlier_type;
                if($o->sample_number==1){$sn_1[]=$item;}

            }

            $inputData  = Input::all(); //echo "<pre>"; print_r($inputData); //exit;
            $icar  = $inputData['icar'];
            $round = $inputData['round'];
            $lab_id =$inputData['lab_id'];

            $data  = Data::where('icar_code',$icar)->Where('round', $round)->get();
            $round = Round::where('laboratory_id',$lab_id)->Where('code_round', $round)->get();
            $lab   = Laboratory::find($lab_id);
           // $lab=$round->lab()->first();
            return view('admin.report.report', compact('data','round','lab','sn_1'));
            // return $labs;
        } catch (\Exception $e) {
            $message = [
                'flashType'    => 'danger',
                'flashMessage' => 'Errore! Laboratorio'
            ];
        }

    }
}
