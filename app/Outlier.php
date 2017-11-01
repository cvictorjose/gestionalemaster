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



    public static function getOutliersRot($icar,$round)
    {
        $code_arr=array('fat_rout','protein_rout','lactose_rout','urea_rout','bhb','pag');
        $arr_sp1=array();

        $round="RT0316";

        $outliers= Outlier::where('round',$round)->where('lab_code',$icar)->orderBy('sample_number')->get();
        for ($i=1; $i<11; $i++) {
            $item= new \stdClass();
            $item->fat_rout ="";
            $item->protein_rout ="";
            $item->lactose_rout ="";
            $item->urea_rout ="";
            $item->bhb ="";
            $item->pag ="";

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

}
