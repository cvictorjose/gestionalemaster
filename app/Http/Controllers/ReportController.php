<?php

namespace App\Http\Controllers;

use App\Data;
use App\Laboratory;
use App\Outlier;
use App\Repeatability;
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
            $inputData  = Input::all(); //echo "<pre>"; print_r($inputData); //exit;
            $icar  = $inputData['icar'];
            $round = $inputData['round'];
            $lab_id =$inputData['lab_id'];

            $code_arr=array('fat_ref','protein_ref','lactose_ref','urea_ref','scc_ref','bhb');

            $arr_sp1=array();
            $repeat= Repeatability::where('round','RF0316')->where('lab_code','1')->get();


            for ($i=1; $i<11; $i++) {
               $item= new \stdClass();
               $item->fat_ref ="";
               $item->protein_ref ="";
               $item->lactose_ref ="";
               $item->scc_ref ="";
               $item->urea_ref ="";
               $item->bhb_ref ="";

               foreach($repeat as $rp)
                {
               foreach ($code_arr as $t){
                   if ($rp->type==$t){


                       //manca la classe


                       if ($i==1)
                           $sample = (filter_var($rp->sample01, FILTER_VALIDATE_INT))? $rp->sample01 :
                               number_format($rp->sample01,3);
                       if ($i==2)
                           $sample = (filter_var($rp->sample02, FILTER_VALIDATE_INT))? $rp->sample02 :
                           number_format($rp->sample02,3);
                       if ($i==3)
                           $sample = (filter_var($rp->sample03, FILTER_VALIDATE_INT))? $rp->sample03 :
                           number_format($rp->sample03,3);
                       if ($i==4)
                           $sample = (filter_var($rp->sample04, FILTER_VALIDATE_INT))? $rp->sample04 :
                           number_format($rp->sample04,3);
                       if ($i==5)
                           $sample = (filter_var($rp->sample05, FILTER_VALIDATE_INT))? $rp->sample05 :
                           number_format($rp->sample05,3);
                       if ($i==6)
                           $sample = (filter_var($rp->sample06, FILTER_VALIDATE_INT))? $rp->sample06 :
                           number_format($rp->sample06,3);
                       if ($i==7)
                           $sample = (filter_var($rp->sample07, FILTER_VALIDATE_INT))? $rp->sample07 :
                           number_format($rp->sample07,3);
                       if ($i==8)
                           $sample = (filter_var($rp->sample08, FILTER_VALIDATE_INT))? $rp->sample08 :
                           number_format($rp->sample08,3);
                       if ($i==9)
                           $sample = (filter_var($rp->sample09, FILTER_VALIDATE_INT))? $rp->sample09 :
                           number_format($rp->sample09,3);
                       if ($i==10)
                           $sample = (filter_var($rp->sample10, FILTER_VALIDATE_INT))? $rp->sample10 :
                           number_format($rp->sample10,3);



                       $item->{$t} =$sample;
                   }
               }
                }
                array_push($arr_sp1,$item);
            }

           // return $arr_sp1;

            $sn_1=$sn_2=$sn_3=$sn_4=$sn_5=$sn_6=$sn_7=$sn_8=$sn_9=$sn_10=array();
            $outliers= Outlier::where('round','RF0316')->where('lab_code','1')->orderBy('sample_number')->get();
            foreach($outliers as $o)
            {
                $item= new \stdClass();
                $item->code  =$o->type;
                $item->outlier=$o->outlier_type;
                if($o->sample_number==1){$sn_1[]=$item;}
            }


            $data  = Data::where('icar_code',$icar)->Where('round', $round)->get();
            $round = Round::where('laboratory_id',$lab_id)->Where('code_round', $round)->get();
            $lab   = Laboratory::find($lab_id);

            return view('admin.report.report', compact('data','round','lab','sn_1','arr_sp1'));

        } catch (\Exception $e) {
            $message = [
                'flashType'    => 'danger',
                'flashMessage' => 'Errore! Laboratorio'
            ];
        }

    }
}
