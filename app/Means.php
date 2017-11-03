<?php

namespace App;

use ArrayObject;
use Illuminate\Database\Eloquent\Model;

class Means extends Model
{
    protected $table = 'means';
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


    public static function getDataCurrentRound($icar,$round,$lab_id)
    {
        //$round="RF0317";

        //INIZIO Blocco Base
        $positions=array();
        $result= Means::where('round',$round)->where('lab_code',$icar)->where('type','fat_ref')->first();

        if (count($result)<1){
            return false;
        }

        $fruits = array(
            "sp1" => number_format($result->sample01,4),
            "sp2" => number_format($result->sample02,4),
            "sp3" => number_format($result->sample03,4),
            "sp4" => number_format($result->sample04,4),
            "sp5" => number_format($result->sample05,4),
            "sp6" => number_format($result->sample06,4),
            "sp7" => number_format($result->sample07,4),
            "sp8" => number_format($result->sample08,4),
            "sp9" => number_format($result->sample09,4),
            "sp10" => number_format($result->sample10,4)
        );
        $fruitArrayObject = new ArrayObject($fruits);
        //ordino array ASC
        $fruitArrayObject->asort();

        //Prendo il numero di sample, sp3,sp1,sp10 ecc
        foreach ($fruitArrayObject as $key => $val) {
            $positions[]=$key;
        }
        //FINE Blocco Base

        //Prendo 2 round precendenti
        $round_precedenti=array();
        $words = substr($round, 0, -4);
        $getIds= Zscorept::where('round',$round)->where('lab_code',$icar)->orderBy('id','desc')->first();
        $getIds2= Zscorept::where('id','<',$getIds->id)->where('round', 'like', $words.'%')->orderBy('id','desc')->get();
        $crash=0;
        foreach($getIds2 as $g)
        {
            if($crash==2) break;
            if (!in_array($g->round, $round_precedenti)) {
                if ($round!=$g->round) {
                    $round_precedenti[]= $g->round;
                    $crash++;
                }
            }
        }


        $final=array();
        $code_arr= Round::checkTestAttivate($lab_id,$round,'ref');
        //return $code_arr;

        foreach ($code_arr as $type) {
            $final['zscorept'][$type]['base']=Zscorept::getBlocksRoundPt($icar,$round,$positions,$type);
            $final['zscorefix'][$type]['base']=Zscorefix::getBlocksRoundFx($icar,$round,$positions,$type);
            //prendo 2 round precendenti a quello attuale
            foreach($round_precedenti as $round)
            {
                $final['zscorept'][$type][$round]=Zscorept::getBlocksRoundPt($icar,$round,$positions,$type);
                $final['zscorefix'][$type][$round]=Zscorefix::getBlocksRoundFx($icar,$round,$positions,$type);
            }
        }

        //ritono CurrentRound=Base,Round1,Round2
        return  (array('currentRound'=>$final,'positions'=>$positions,'rounds'=>$round_precedenti,'codetest'=>$code_arr));
    }




}
