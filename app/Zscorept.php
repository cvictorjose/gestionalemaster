<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zscorept extends Model
{
    protected $table = 'zscore-pt';
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



    public static function getZScorePt($data2,$round)
    {
        $final=array();
        foreach($data2 as $dt)
        {
            $r= Zscorept::where('round',$round)->where('lab_code',$dt->lab_code)->where('type',$dt->type)->first();

            if (count($r)>0){
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
        }
        return $final;
    }


    public static function getBlocksRoundPt($lab_id,$round,$positions,$type)
    {
        $currentRound=array();
        $dataZscorePT= Zscorept::where('round',$round)->where('lab_code',$lab_id)->where('type',$type)->first();

        if ($dataZscorePT){
            foreach ($positions[$type] as $p){
                switch ($p) {
                    case 'sp1':
                        $currentRound[]=number_format($dataZscorePT->sample01,4);
                        break;
                    case 'sp2':
                        $currentRound[]=number_format($dataZscorePT->sample02,4);
                        break;
                    case 'sp3':
                        $currentRound[]=number_format($dataZscorePT->sample03,4);
                        break;
                    case 'sp4':
                        $currentRound[]=number_format($dataZscorePT->sample04,4);
                        break;
                    case 'sp5':
                        $currentRound[]=number_format($dataZscorePT->sample05,4);
                        break;
                    case 'sp6':
                        $currentRound[]=number_format($dataZscorePT->sample06,4);
                        break;
                    case 'sp7':
                        $currentRound[]=number_format($dataZscorePT->sample07,4);
                        break;
                    case 'sp8':
                        $currentRound[]=number_format($dataZscorePT->sample08,4);
                        break;
                    case 'sp9':
                        $currentRound[]=number_format($dataZscorePT->sample09,4);
                        break;
                    case 'sp10':
                        $currentRound[]=number_format($dataZscorePT->sample10,4);
                        break;
                }
            }
            return $currentRound;
        }
        return array(0,0,0,0,0,0,0,0,0,0);
    }
}
