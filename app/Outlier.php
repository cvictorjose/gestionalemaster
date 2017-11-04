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

    public static function getOutliers($data,$round)
    {
        $out_labs=array();
        foreach($data as $dt)
        {
            $outliers= Outlier::where('round',$round)->where('lab_code',$dt->lab_code)->where('type',$dt->type)->get();

            $item= new \stdClass();
            $item->fat_ref ="";
            $item->protein_ref ="";
            $item->lactose_ref ="";
            $item->scc_ref ="";
            $item->urea_ref ="";

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
    }

}
