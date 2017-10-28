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


    /**
     * Show the form for editing Lab.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $lab = Laboratory::findOrFail($id);
            return view('admin.laboratory.edit', compact('lab'));
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
        $inputData = $request->only('icar_code','lab_name','status');

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
            $new->text=$p->lab_name;
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
