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


    public static function getDataCurrentRound($round,$code_arr,$icar)
    {
        $positions=array();
        $code_attivati=array();

        foreach ($code_arr as $type) {
            $result= Means::where('round',$round)->where('lab_code','REF.')->where('type',$type)->first();

            if (count($result)>0){
                //creo new array test attivati
                $code_attivati[]=$type;
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
                    $positions[$type][]=$key;
                }
            }
        }
       // return  (array('positions'=>$positions));



        //Prendo 2 round precendenti
        $rounds_precedenti=Round::getRoundsPrecedenti($round);
        //return $rounds_precedenti;

        $final=array();
        foreach ($positions as $type => $val) {
            $result= Data::where('round',$round)->where('icar_code',$icar)->where('round',$round)->where('type',$type)->first();
            $lab_id=$result->lab_code;
            $final['zscorept'][$type]['base']=Zscorept::getBlocksRoundPt($lab_id,$round,$positions,$type);
            $final['zscorefix'][$type]['base']=Zscorefix::getBlocksRoundFx($lab_id,$round,$positions,$type);

            //prendo 2 round precendenti a quello attuale
            foreach($rounds_precedenti as $cr)
            {
                $final['zscorept'][$type][$cr->code_round]=Zscorept::getBlocksRoundPt($lab_id,$cr->code_round,$positions,$type);
                $final['zscorefix'][$type][$cr->code_round]=Zscorefix::getBlocksRoundFx($lab_id,$cr->code_round,$positions,$type);
            }
        }
        return  (array('currentRound'=>$final,'positions'=>$positions,'codetest'=>$code_attivati,'cr_before'=>$rounds_precedenti));
    }
}
