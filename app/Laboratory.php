<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;


class Laboratory extends Model
{
    protected $table = 'laboratory';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'icar_code','lab_name','status'
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
     * Check username user and return true or false.
     *
     * @return mixed
     */


    protected function checkCodeLab($code){
        try {
            return Laboratory::where('icar_code', $code)->get()->isNotEmpty();
        } catch (Exception $e) {
            return false;
        }
    }

}
