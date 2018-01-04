<?php

namespace App\Http\Controllers;

use App\Country;
use App\Laboratory;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;


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
            $id         = $inputData['laboratory_id'];
            $invoice    = $inputData['invoice_no'];
            $date       = $inputData['date'];
            $activities = $inputData['activities'];

            //$id   =1;
            $lab   = Laboratory::findOrFail($id);


            if (is_null($lab->invoice_country) || is_null($lab->invoicetype) || is_null($lab->vat_number) || is_null
                ($lab->contatto_amministrativo) || is_null($lab->invoice_address) || is_null($lab->invoice_cap) || is_null($lab->invoice_city) || is_null($lab->invoice_country)){

                $message = [
                    'flashType'    => 'danger',
                    'flashMessage' => 'Errore! Dati mancanti per generare la fattura'
                ];
                return back()->withInput()->with($message);
            }

            $country=Country::where('iso',$lab->invoice_country)->first();
            $lab->invoice_country=$country->nicename;


            $iva=$total_ref=$total_rout=0;

            $total_ref= $lab->fat_ref + $lab->protein_ref + $lab->lactose_ref + $lab->urea_ref + $lab->scc_ref;
            $total_rout= $lab->fat_rout + $lab->protein_rout + $lab->lactose_rout + $lab->urea_rout + $lab->bhb +
                $lab->pag + $lab->dna;

            $total= $total_ref+$total_rout + $lab->participation_fee + $lab->shipment_cost;


            if ($lab->invoicetype=="IT")
                $iva= $total * 0.22;
                $lab->iva=$iva;


            $lab->total_ref=($total_ref>0)?1:0;
            $lab->total_rout=($total_rout>0)?1:0;
            $lab->total=$total+$iva;


            $dompdf = new Dompdf();
            $view =  \View::make('admin.invoice.template', compact('lab','invoice','date','activities'))->render();
            $dompdf->loadHtml($view);
            $dompdf->render();
            $dompdf->stream();

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
}
