<?php

namespace App;

use ArrayObject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Response;

class Repeatability extends Model
{
    protected $table = 'repeatability';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type','round','lab_code','sample01','sample02','sample03','sample04','sample05','sample06','sample07',
        'sample08','sample09','sample10'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];


    public static function getRepeat($icar,$round)
    {
        $code_arr=array('fat_ref','protein_ref','lactose_ref','urea_ref','scc_ref','bhb');

        $arr_sp1=array();
        $repeat= Repeatability::where('round',$round)->where('lab_code',$icar)->get();
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
        return $arr_sp1;
    }



    public static function getDataCurrentRound($icar,$round)
    {
        $positions=array();
        $repeat= Repeatability::where('round',$round)->where('lab_code',$icar)->where('type','fat_ref')->first();

        $fruits = array(
            "sp1" => number_format($repeat->sample01,4),
            "sp2" => number_format($repeat->sample02,4),
            "sp3" => number_format($repeat->sample03,4),
            "sp4" => number_format($repeat->sample04,4),
            "sp5" => number_format($repeat->sample05,4),
            "sp6" => number_format($repeat->sample06,4)
        );
        $fruitArrayObject = new ArrayObject($fruits);
        $fruitArrayObject->asort();

        foreach ($fruitArrayObject as $key => $val) {
            $positions[]=$key;
        }


        $currentRound=array();
        $dataZscorePT= Zscorept::where('round',$round)->where('lab_code',$icar)->where('type','fat_ref')->first();

        foreach ($positions as $p){
            switch ($p) {
                case 'sp1':
                    $currentRound[]=number_format($dataZscorePT->sample01,4);
                    break;
                case 'sp2':
                    $currentRound[]=$dataZscorePT->sample02;
                    break;
                case 'sp3':
                    $currentRound[]=$dataZscorePT->sample03;
                    break;
                case 'sp4':
                    $currentRound[]=$dataZscorePT->sample04;
                    break;
                case 'sp5':
                    $currentRound[]=$dataZscorePT->sample05;
                    break;
                case 'sp6':
                    $currentRound[]=$dataZscorePT->sample06;
                    break;
            }
        }

        return $currentRound;
       // return  (array('currentRound'=>$fruitArrayObject,'positions'=>$positions));

        /*
        if ($i==1) $sample= (filter_var($rp->sample01, FILTER_VALIDATE_INT))? $rp->sample01 : number_format($rp->sample01,4);
                $item->sp1=$sample;
       */
    }
}
