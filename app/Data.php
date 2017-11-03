<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $table = 'data';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['icar_code', 'round'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
//    protected $hidden = [
//        'created_at', 'updated_at',
//    ];

    public static function getData($icar,$round,$code_arr)
    {
        //$code_arr=array('fat_ref','protein_ref','lactose_ref','urea_ref','scc_ref','bhb');
        $arr_data=array();

        $results= Data::where('icar_code',$icar)->Where('round', $round)->get();
        foreach($results as $rp)
        {
            foreach ($code_arr as $t){
                if ($rp->type==$t){
                    $arr_data[]=$rp;
                }
            }
        }
        return $arr_data;
    }
}
