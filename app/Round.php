<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    protected $table = 'round';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'laboratory_id','code_round','results_received','results_received_date','code_test','question1',
        'question2','status'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];


    public function lab(){
        try {
            return $this->belongsTo(Laboratory::class, 'laboratory_id');
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Controlla se un Test è stato già registrato
     *
     * @var array
     */
    public static function TestChecked($data){
        try {
           $results = Round::where('laboratory_id',$data['lab'])->Where('code_round', $data['round'])->get();
            foreach ($results as $r){
                if ($data['test']==$r->code_test) return 1;
            }
            return 0;
        } catch (Exception $e) {
            return false;
        }
    }

}
