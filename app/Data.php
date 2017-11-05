<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

        $arr_data=array();
        $arr_data2=array();

        $results= Data::where('icar_code',$icar)->Where('round', $round)->get();
        foreach($results as $rp)
        {
            foreach ($code_arr as $t){
                if ($rp->type==$t){
                    $arr_data[]=$rp;
                }
            }
        }

        //prendo solo type labcode del round
        $data2 = DB::table('data')
            ->select(DB::raw('type, lab_code'))
            ->Where('round', $round)
            ->Where('icar_code', $icar)
            ->get();


        foreach($data2 as $d)
        {
            foreach ($code_arr as $t){
                if ($d->type==$t){
                    $arr_data2[]=$d;
                }
            }
        }

        $final= array('d'=>$arr_data, 'd2'=>$arr_data2);
        return $final;
    }
}
