<?php

namespace App\Http\Controllers;

use App\Laboratory;
use App\Round;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function index()
    {
        try {
            $round="RF0917";
            $data   = Round::select('laboratory_id','code_test')->where('code_round',$round)->get();

            $last_id=0;
            $labs=array();

            foreach($data as $column => $d)
            {

                if ($last_id!=$d->laboratory_id){

                    if ($last_id!=0){$labs[]=$new;}

                    $lab = Laboratory::find($d->laboratory_id);

                    $new= new \stdClass();
                    $new->id=$d->laboratory_id;

                    $new->lab_name                = $lab->lab_name;
                    $new->icar_code               = $lab->icar_code;
                    $new->invoice_address         = $lab->invoice_address;
                    $new->invoice_city            = $lab->invoice_city;
                    $new->invoice_country         = $lab->invoice_country;
                    $new->contatto_amministrativo = $lab->contatto_amministrativo;
                    $new->email                   = $lab->email;


                    $new->{$d->code_test}=1;

                }else{
                    $new->{$d->code_test}=1;
                }

                $last_id=$d->laboratory_id;
            }
          //  return $labs;

        } catch (\Exception $e) {
            $message = [
                'flashType'    => 'danger',
                'flashMessage' => 'Errore! CSV'
            ];
        }
        return view('admin.export.index', compact('labs'));
    }
}
