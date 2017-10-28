<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pag extends Model
{
    protected $table = 'pag';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'row','round','lab_code','icar_code','sample01','sample02','sample03','sample04','sample05'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];



    public static function getPag($icar,$round)
    {

        $results= DB::table('pag')
            ->where('round', '=', $round)
            ->Where(function ($query) use ( $icar ) {
                $query->where('icar_code', '=', $icar)
                    ->orwhere('lab_code', '=', 'all');
            })
            ->get();

        return $results;

    }
}
