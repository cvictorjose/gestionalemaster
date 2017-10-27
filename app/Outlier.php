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
    }
}
