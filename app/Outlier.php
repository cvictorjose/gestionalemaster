<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outlier extends Model
{
    protected $table = 'outliers';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type','round','lab_code','outlier_type','sample_numer'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public static function getOutliers($icar,$round)
    {
        $code_arr=array('fat_ref','protein_ref','lactose_ref','urea_ref','scc_ref','bhb');
        $arr_sp1=array();

        $outliers= Outlier::where('round',$round)->where('lab_code',$icar)->orderBy('sample_number')->get();
        for ($i=1; $i<11; $i++) {
            $item= new \stdClass();
            $item->fat_ref ="";
            $item->protein_ref ="";
            $item->lactose_ref ="";
            $item->scc_ref ="";
            $item->urea_ref ="";
            $item->bhb_ref ="";

            foreach($outliers as $rp)
            {
                foreach ($code_arr as $t){
                    if ($rp->sample_number==$i && $rp->type==$t){
                         $sample = $rp->outlier_type;
                         $item->{$t} =$sample;
                         $item->riga =$rp->sample_number;
                    }
                }
            }
            array_push($arr_sp1,$item);
        }
        return $arr_sp1;
    }



    /*public static function getOutliers($icar,$round)
    {

        $sn_1=$sn_2=$sn_3=$sn_4=$sn_5=$sn_6=$sn_7=$sn_8=$sn_9=$sn_10=array();
        $outliers= Outlier::where('round',$round)->where('lab_code',$icar)->orderBy('sample_number')->get();
        foreach($outliers as $o)
        {
            $item= new \stdClass();
            $item->code  =$o->type;
            $item->outlier=$o->outlier_type;
            if($o->sample_number==1){$sn_1[]=$item;}
        }
        return $sn_1;
    }*/
}
