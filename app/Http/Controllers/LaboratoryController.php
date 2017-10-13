<?php

namespace App\Http\Controllers;

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
        return view('admin.laboratory.create');
    }


    public function store()
    {
        $inputData  = Input::all(); //echo "<pre>"; print_r($inputData); exit;
        if(!empty($inputData) && count($inputData)> 0) {
            $rules = [
                'icar_code' => 'required',
                'lab_name'  => 'required'
            ];

            $messages = [
                'required' => 'Controllare tutti i campi obbligatori (*).',
                'unique'   => strtoupper(':attribute_busy'),
                'max'      => strtoupper(':attribute_too_long'),
                'min'      => strtoupper(':attribute_too_short')
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
                    $lab = new Laboratory();
                    $lab->icar_code = Input::get('icar_code');
                    $lab->lab_name  = Input::get('lab_name');
                    $lab->status    = (Input::get('status'))? '1' : '0';
                    $lab->save();
                    //$status         = array('stat'=>'ok', 'msg'=>'Laboratorio aggiunto','mode'=>'add');

                    $message = [
                        'flashType'    => 'success',
                        'flashMessage' => 'Laboratorio aggiunto con successo!'
                    ];

                } catch (\Exception $e) {
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
        /*if (! Gate::allows('users_manage')) {
            return abort(401);
        }*/





        try {
            $lab = Laboratory::findOrFail($id);
            $lab->delete();
            //da controllare se ce anche nel round o altri tb
            //Story::where('user_id',$result->_id)->delete();
            return redirect()->route('laboratorio.index');
        } catch (Exception $e) {
            return $this->createCodeMessageError($e);
        }
    }
}
