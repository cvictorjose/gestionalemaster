<?php

namespace App;

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


    public static function getRepeat($data2,$round)
    {

        $array=array();
        foreach($data2 as $dt)
        {
            $r= Repeatability::where('round',$round)->where('lab_code',$dt->lab_code)->where('type',$dt->type)->first();

            $sp1 = (filter_var($r->sample01, FILTER_VALIDATE_INT))? $r->sample01 : number_format($r->sample01,3);
            $sp2 = (filter_var($r->sample02, FILTER_VALIDATE_INT))? $r->sample02 : number_format($r->sample02,3);
            $sp3 = (filter_var($r->sample03, FILTER_VALIDATE_INT))? $r->sample03 : number_format($r->sample03,3);
            $sp4 = (filter_var($r->sample04, FILTER_VALIDATE_INT))? $r->sample04 : number_format($r->sample04,3);
            $sp5 = (filter_var($r->sample05, FILTER_VALIDATE_INT))? $r->sample05 : number_format($r->sample05,3);
            $sp6 = (filter_var($r->sample06, FILTER_VALIDATE_INT))? $r->sample06 : number_format($r->sample06,3);
            $sp7 = (filter_var($r->sample07, FILTER_VALIDATE_INT))? $r->sample07 : number_format($r->sample07,3);
            $sp8 = (filter_var($r->sample08, FILTER_VALIDATE_INT))? $r->sample08 : number_format($r->sample08,3);
            $sp9 = (filter_var($r->sample09, FILTER_VALIDATE_INT))? $r->sample09 : number_format($r->sample09,3);
            $sp10 = (filter_var($r->sample10, FILTER_VALIDATE_INT))? $r->sample10 : number_format($r->sample10,3);

            $array=array(
                "sp1"=>$sp1,"sp2"=>$sp2,
                "sp3"=>$sp3,"sp4"=>$sp4,
                "sp5"=>$sp5,"sp6"=>$sp6,
                "sp7"=>$sp7,"sp8"=>$sp8,
                "sp9"=>$sp9,"sp10"=>$sp10
                );

            $final[$dt->type]=$array;
        }

        return $final;
    }



   /* public static function getRepeatRot($icar,$round,$code_arr)
    {

        $arr_sp1=array();
        $repeat= Repeatability::where('round',$round)->where('lab_code',$icar)->get();

        for ($i=1; $i<11; $i++) {
            $item= new \stdClass();
            $item->fat_rout ="";
            $item->protein_rout ="";
            $item->lactose_rout ="";
            $item->scc_rout ="";
            $item->urea_rout ="";
            $item->bhb ="";
            $item->pag ="";

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
    }*/

}
