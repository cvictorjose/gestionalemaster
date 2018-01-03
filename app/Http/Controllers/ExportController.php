<?php

namespace App\Http\Controllers;

use App\Laboratory;
use App\Round;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\Csv\Writer;
use SplTempFileObject;

class ExportController extends Controller
{
    public function index()
    {
        try {
            //$round="0917";
            $round=Round::getLastRoundNumbers();
            //$data   = Round::select('laboratory_id','code_test')->where('code_round',$round)->get();

            $data   = Round::select('laboratory_id','code_test')->where('code_round', 'like', '%' .$round. '%')
                ->orderBy('laboratory_id', 'ASC')->get();

            //   return $data;

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

      //  return $labs;

       $this->createCsv($labs);
        // return view('admin.export.index', compact('labs'));
    }





    /**
     * Create a csv from whitelist
     *
     * @return \Illuminate\Http\Response
     */
    public function createCsv($csv)
    {
        try {
            $writer = Writer::createFromFileObject(new SplTempFileObject());
            $writer->setDelimiter(";");
            $writer->insertOne([
                'ICAR Code', 'Laboratorio', 'Delivery Address',
                'City', 'Country', 'Contact person','Email',
                'Fat_ref','Protein_ref','Lactose_ref', 'Urea_ref', 'Scc_ref',
                'Fat_rout','Protein_rout', 'Lactose_rout', 'Urea_rout',
                'BHB','PAG', 'DNA'
            ]);


            foreach ($csv as $e) {

                $records = [
                    [
                        "*".$e->icar_code,
                        $e->lab_name,
                        $e->invoice_address,
                        $e->invoice_city,
                        $e->invoice_country,
                        $e->contatto_amministrativo,
                        $e->email,
                        (isset($e->fat_ref))?1:0 ,
                        (isset($e->protein_ref))?1:0 ,
                        (isset($e->lactose_ref))?1:0 ,
                        (isset($e->urea_ref))?1:0 ,
                        (isset($e->scc_ref))?1:0 ,
                        (isset($e->fat_rout))?1:0 ,
                        (isset($e->protein_rout))?1:0 ,
                        (isset($e->lactose_rout))?1:0 ,
                        (isset($e->urea_rout))?1:0 ,
                        (isset($e->bhb))?1:0 ,
                        (isset($e->pag))?1:0 ,
                        (isset($e->dna))?1:0 ,

                    ],
                ];
                $writer->insertAll($records);
            }
            $writer->output('people.csv');exit;
            // Storage::disk('csv')->put('round0917.csv', $writer);

        } catch (Exception $e) {
            $message = [
                'flashType'    => 'danger',
                'flashMessage' => 'Errore! CSV'
            ];
        }
    }
}
