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



    /**
     * Controlla i test che vengo in data, prende lab_id e fa la query, per la categoria REF
     *
     * @var array
     */
    public static function getOutliers($data,$round)
    {
        $out_labs=array();
        foreach($data as $dt)
        {
            $outliers= Outlier::where('round',$round)->where('lab_code',$dt->lab_code)->where('type',$dt->type)->get();
            $item= new \stdClass();

            foreach($outliers as $rp)
            {
                for ($i=1; $i<11; $i++) {
                    if ($rp->sample_number==$i){
                        $item  = $rp->outlier_type;
                        $out_labs[$i][$dt->type]=$item;
                    }
                }
            }
        }
        return $out_labs;
    }

    /**
     * Controlla i test che vengo in data, prende lab_id e fa la query, per la categoria ROUT
     *
     * @var array
     */
    /*public static function getOutliersRot($data,$round)
    {
        $out_labs=array();
        foreach($data as $dt)
        {
            $outliers= Outlier::where('round',$round)->where('lab_code',$dt->lab_code)->where('type',$dt->type)->get();

            $item= new \stdClass();
            $item->fat_rout ="";
            $item->protein_rout ="";
            $item->lactose_rout ="";
            $item->urea_rout ="";
            $item->bhb ="";
            $item->pag ="";

            for ($i=1; $i<11; $i++) {
                foreach($outliers as $rp)
                {
                    if ($rp->sample_number==$i){
                        $item->{$dt->type}        = $rp->outlier_type;
                        $out_labs[$i]=$item;
                    }
                }
            }
        }
        return $out_labs;
    }*/

}
