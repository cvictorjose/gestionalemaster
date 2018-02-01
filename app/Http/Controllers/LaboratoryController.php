<?php

namespace App\Http\Controllers;

use App\CodeTest;
use App\Country;
use App\Laboratory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LaboratoryController extends Controller
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
        return view('admin.laboratory.index', compact('labs'));
    }


    public function create()
    {
        $tests = CodeTest::all();
         $countries=Country::pluck('nicename','iso');
        return view('admin.laboratory.create', compact('tests','countries'));
    }


    /**
     * Show the form for editing Lab.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $lab   = Laboratory::findOrFail($id);
            $tests = CodeTest::all();
            $countries=Country::pluck('nicename','iso');
            return view('admin.laboratory.edit', compact('lab','tests','countries'));
        } catch (Exception $e) {
            //log
        }
    }


    /**
     * Update Lab in storage.
     *
     * @param    $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $lab = Laboratory::find($id);
        $inputData = $request->only('icar_code','lab_name','status',
            'nominativo_contatto',
            'email',
            'spedizione_address',
            'spedizione_cap',
            'spedizione_city',
            'spedizionecountry',
            'ente_associato','',
            'contatto_amministrativo',
            'email_amministrativa',
            'invoice_address',
            'invoice_cap',
            'invoice_city',
            'invoicecountry',
            'vat_number',
            'participation_fee',
            'shipment_cost','fat_ref',
            'protein_ref','lactose_ref','urea_ref','scc_ref',
            'fat_rout','protein_rout','lactose_rout','urea_rout',
            'bhb','pag','dna','invoicetype');

        if(!empty($inputData) && count($inputData)> 0) {
            $rules = [
                'icar_code' => 'required|unique:laboratory,icar_code,'. $id,
                'lab_name'  => 'required|min:3|max:100',
            ];
            $messages = [
                'required' => 'Controllare tutti i campi obbligatori (*).',
                'unique'   => 'Il codice del laboratorio esiste sul DB',
                'max'      => 'Il nome del laboratorio deve avere massimo 100 caratteri',
                'min'      => 'Il nome del laboratorio deve avere minimo 3 caratteri'
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
            }
            else {
                foreach($inputData as $column => $value)
                {
                    if($value!=null)
                        switch ($column){
                            case 'spedizionecountry':
                                $lab->spedizione_country  = Input::get('spedizionecountry');
                                 break;

                            case 'invoicecountry':
                                $lab->invoice_country  = Input::get('invoicecountry');
                                break;

                            default:
                                $lab->{$column}=$value;
                                break;
                        }
                }
                $lab->status  = (Input::get('status'))? '1' : '0';
                $lab->save();

                $message = [
                    'flashType'    => 'success',
                    'flashMessage' => 'Laboratorio aggiornato',
                    'mode'=>'edit'
                ];
            }
        }
        return redirect()->route('laboratorio.edit', ['id' => $id])->with($message);
    }

    /**
     * Store a newly created Lab in storage.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $inputData  = Input::all(); //echo "<pre>"; print_r($inputData); exit;
        if(!empty($inputData) && count($inputData)> 0) {
            $rules = [
                'icar_code' => 'required|unique:laboratory',
                'lab_name'  => 'required|min:3|max:100',
            ];

            $messages = [
                'required' => 'Controllare tutti i campi obbligatori (*).',
                'unique'   => 'Il codice del laboratorio esiste sul DB',
                'max'      => 'Il nome del laboratorio deve avere massimo 100 caratteri',
                'min'      => 'Il nome del laboratorio deve avere minimo 3 caratteri'
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

                try {
                   $checkCode=Laboratory::checkCodeLab(Input::get('icar_code'));
                    if ($checkCode) {
                        $message = [
                            'flashType'    => 'danger',
                            'flashMessage' => 'Il codice del laboratorio esiste gia nel DB'
                        ];
                        return back()->withInput()->with($message);
                    }else{
                        $lab = new Laboratory();
                        $lab->icar_code = Input::get('icar_code');
                        $lab->lab_name  = Input::get('lab_name');
                        $lab->status    = (Input::get('status'))? '1' : '0';

                        $lab->nominativo_contatto     = Input::get('nominativo_contatto');
                        $lab->email                   = Input::get('email');
                        $lab->spedizione_address      = Input::get('spedizione_address');
                        $lab->spedizione_cap          = Input::get('spedizione_cap');
                        $lab->spedizione_city         = Input::get('spedizione_city');
                        $lab->spedizione_country      = Input::get('spedizionecountry');
                        $lab->contatto_amministrativo = Input::get('contatto_amministrativo');
                        $lab->email_amministrativa    = Input::get('email_amministrativa');
                        $lab->ente_associato          = Input::get('ente_associato');
                        $lab->vat_number              = Input::get('vat_number');
                        $lab->invoice_address         = Input::get('invoice_address');
                        $lab->invoice_cap             = Input::get('invoice_cap');
                        $lab->invoice_city            = Input::get('invoice_city');
                        $lab->invoice_country         = Input::get('invoicecountry');
                        $lab->invoicetype             = Input::get('invoicetype');
                        $lab->participation_fee       = Input::get('participation_fee');
                        $lab->shipment_cost           = Input::get('shipment_cost');

                        $lab->fat_ref           = 1;
                        $lab->protein_ref       = 1;
                        $lab->lactose_ref       = 1;
                        $lab->urea_ref          = 1;
                        $lab->scc_ref           = 1;
                        $lab->fat_rout          = 1;
                        $lab->protein_rout      = 1;
                        $lab->lactose_rout      = 1;
                        $lab->urea_rout         = 1;
                        $lab->bhb               = 1;
                        $lab->pag               = 1;
                        $lab->dna               = 1;

                        /*$lab->fat_ref           = Input::get('fat_ref');
                        $lab->protein_ref       = Input::get('protein_ref');
                        $lab->lactose_ref       = Input::get('lactose_ref');
                        $lab->urea_ref          = Input::get('urea_ref');
                        $lab->scc_ref           = Input::get('scc_ref');
                        $lab->fat_rout          = Input::get('fat_rout');
                        $lab->protein_rout      = Input::get('protein_rout');
                        $lab->lactose_rout      = Input::get('lactose_rout');
                        $lab->urea_rout         = Input::get('urea_rout');
                        $lab->bhb               = Input::get('bhb');
                        $lab->pag               = Input::get('pag');
                        $lab->dna               = Input::get('dna');*/



                        $lab->save();
                        //$status         = array('stat'=>'ok', 'msg'=>'Laboratorio aggiunto','mode'=>'add');

                        $message = [
                            'flashType'    => 'success',
                            'flashMessage' => 'Laboratorio aggiunto con successo!'
                        ];
                    }

                } catch (\Exception $e) {
                    //log
                    $message = [
                        'flashType'    => 'danger',
                        'flashMessage' => 'Errore! Controllare i dati di inserimento del Laboratorio'
                    ];
                }
            }
        }
        return redirect()->route('laboratorio.index')->with($message);
    }

    /**
     * Remove Lab from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $lab = Laboratory::findOrFail($id);
            $lab->delete();
            //da controllare se ce anche nel round o altri tb
            //Story::where('user_id',$result->_id)->delete();
            $message = [
                'flashType'    => 'success',
                'flashMessage' => 'Laboratorio eliminato con successo!'
            ];
            return redirect()->route('laboratorio.index')->with($message);
        } catch (Exception $e) {
            $message = [
                'flashType'    => 'danger',
                'flashMessage' => 'Errore! Controllare Laboratorio'
            ];
        }
    }

    public function ajaxData(Request $request)
    {
        $query = $request->get('query','');
        $posts = Laboratory::where('lab_name','LIKE','%'.$query.'%')->get();

        $results= array();

        foreach ($posts as $p){
            $new= new \stdClass();
            $new->id  =$p->id;
            $new->text=$p->icar_code." - ".$p->lab_name;
            $results[]=$new;
        }
        return response()->json(['results' => $results]);
//        return $posts;

       /* $query = $request->get('query','');
        $posts = Laboratory::where('lab_name','LIKE','%'.$query.'%')->get();

        $data=array();
        foreach ($posts as $product) {
            $data[]=$product->lab_name;
        }
        if(count($data))
            return $data;
        else
            return ['value'=>'No Result Found','id'=>''];*/
    }


}
