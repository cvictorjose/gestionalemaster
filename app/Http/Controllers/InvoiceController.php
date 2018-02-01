<?php

namespace App\Http\Controllers;

use App\CodeTest;
use App\Country;
use App\Laboratory;
use App\Round;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


class InvoiceController extends Controller
{
    public function index()
    {
        try {
            $labs = Laboratory::all();
        } catch (\Exception $e) {
            $message = [
                'flashType'    => 'danger',
                'flashMessage' => 'Errore! Laboratorio'
            ];
        }
        return view('admin.invoice.create', compact('labs'));
    }


    public function create()
    {
        try {
            $labs = Laboratory::all();
        } catch (\Exception $e) {
            $message = [
                'flashType'    => 'danger',
                'flashMessage' => 'Errore! Laboratorio'
            ];
        }
        return view('admin.invoice.create', compact('labs'));
    }



    public function store()
    {
        try {
            $inputData  = Input::all(); //echo "<pre>"; print_r($inputData); exit;
            $rules = [
                'laboratory_id' => 'required',
                'itemselect'  => 'required',
                'invoice_no'  => 'required',
                'date'  => 'required',
            ];

            $messages = [
                'required' => 'Controllare tutti i campi obbligatori (*).'
            ];

            $validator = Validator::make(Input::all(), $rules, $messages);
            if ($validator->fails())
            {
                $status   =  $validator->errors()->all();
                $message = [
                    'flashType'    => 'danger',
                    'flashMessage' => $status[0]
                ];
                return back()->withInput()->with($message);
                //return redirect()->route('laboratorio.create')->with($message);
            } else {


                $id         = $inputData['laboratory_id'];
                $itemselect = $inputData['itemselect'];
                $round      = substr($itemselect, 2, 4);
                $invoice    = $inputData['invoice_no'];
                $date       = $inputData['date'];
                $activities = $inputData['activities'];


                $lab   = Laboratory::findOrFail($id);
                if (is_null($lab->invoice_country) || is_null($lab->invoicetype) || is_null($lab->vat_number) || is_null
                    ($lab->contatto_amministrativo) || is_null($lab->invoice_address) || is_null($lab->invoice_cap) || is_null($lab->invoice_city) || is_null($lab->invoice_country))
                {
                    $message = [
                        'flashType'    => 'danger',
                        'flashMessage' => 'Errore! Dati mancanti del Laboratorio per generare la fattura'
                    ];
                    return back()->withInput()->with($message);
                }

                $country=Country::where('iso',$lab->invoice_country)->first();
                $lab->invoice_country=$country->nicename;



                $list_test  = Round::select('code_test')->where('laboratory_id', $id)->where('code_round','like', '%'.$round. '%')->get();

                $iva=$total_ref=$total_rout=0;

                $allcoderest= CodeTest::all();
                $template_codetest= new \stdClass();
                $template_codetest->fat_ref     =0;
                $template_codetest->protein_ref =0;
                $template_codetest->lactose_ref =0;
                $template_codetest->urea_ref    =0;
                $template_codetest->scc_ref     =0;

                $template_codetest->fat_rout    =0;
                $template_codetest->protein_rout=0;
                $template_codetest->lactose_rout=0;
                $template_codetest->urea_rout   =0;
                $template_codetest->bhb         =0;
                $template_codetest->pag         =0;
                $template_codetest->dna         =0;

                foreach ($allcoderest as $a){
                    foreach ($list_test as $t){
                        if ($t->code_test == $a->code){
                            $template_codetest->{$a->code}= $this->formatPrice($a->price);
                            if ($a->id<6){
                                $total_ref=$total_ref+$a->price;
                            }else{
                                $total_rout=$total_rout+$a->price;
                            }

                        }
                    }
                }


                //TOTALE TEST + SHIP + FEE
                $total= $total_ref+$total_rout + $lab->participation_fee + $lab->shipment_cost;
                $total=$this->formatPrice($total);

                //IVA SOLO PER ITALIA
                if ($lab->invoicetype=="IT")
                    $iva= $total * 0.22;
                $lab->iva=$this->formatPrice($iva);

                $lab->participation_fee=$this->formatPrice($lab->participation_fee);
                $lab->shipment_cost    =$this->formatPrice($lab->shipment_cost);

                $lab->total_ref=($total_ref>0)?1:0;
                $lab->total_rout=($total_rout>0)?1:0;
                $lab->total=$this->formatPrice($total+$iva);

                $dompdf = new Dompdf();
                $view =  \View::make('admin.invoice.template', compact('lab','invoice','date','activities','template_codetest'))->render();
                $dompdf->loadHtml($view);
                $dompdf->render();
                $dompdf->stream("document_".$invoice."_".$date.".pdf");

            }

            //   return view('admin.invoice.template');
         /*   $view =  \View::make('admin.invoice.template')->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            $output = $pdf->output();
            file_put_contents('../storage/invoices/1-invoice.pdf', $output);
            return ("Pdf invoice created");*/


        } catch (\Exception $e) {
            $message = [
                'flashType'    => 'danger',
                'flashMessage' => 'Errore! Invoice Template'
            ];
        }
        // return view('admin.invoice.template', compact('lab','invoice','date','activities'));
    }

    public function formatPrice($value){
        return number_format($value, 2, ',', ' ');
    }
}
