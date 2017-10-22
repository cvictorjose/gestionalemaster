<?php

namespace App\Http\Controllers;

use App\CodeTest;
use App\Round;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class RoundController extends Controller
{
    //call carica all labo d un round -- $rounds = Round::select('code_round','created_at','laboratory_id')->distinct()->get();

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $rounds = Round::select('code_round')->distinct()->get();
        } catch (\Exception $e) {
            $message = [
                'flashType'    => 'danger',
                'flashMessage' => 'Errore! Laboratorio'
            ];
        }
     return view('admin.round.index', compact('rounds'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function roundlab()
    {
        try {
            $labs = Round::select('code_round','created_at','laboratory_id')->distinct()->get();
        } catch (\Exception $e) {
            $message = [
                'flashType'    => 'danger',
                'flashMessage' => 'Errore! Laboratorio'
            ];
        }
        return view('admin.round.labs', compact('labs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $tests = CodeTest::all();
        } catch (\Exception $e) {
            $message = [
                'flashType'    => 'danger',
                'flashMessage' => 'Errore! CodeTest'
            ];
        }
        return view('admin.round.create', compact('tests'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputData  = Input::all(); echo "<pre>"; print_r($inputData); //exit;
        if(!empty($inputData) && count($inputData)> 0) {
            $rules = [
                'laboratory_id' => 'required',
                'code_round'      => 'required|min:4|max:4',
            ];

            $messages = [
                'required' => 'Controllare tutti i campi obbligatori (*).',
                'unique'   => 'Il codice del laboratorio esiste sul DB',
                'max'      => 'Code Round deve avere massimo 4 digiti',
                'min'      => 'Code Round deve avere minimo 4 digiti'
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
            } else {

                try {
                    $code_test= CodeTest::where('status','1')->get(['code']);


                    foreach ($code_test as $ct){

                        $test_active  = (Input::get($ct->code))? 1 : 0;

                        if ($test_active == 1){
                            echo "entro-----".$ct->code;
                            $item = new Round();
                            $item->laboratory_id         = Input::get('laboratory_id');
                            $item->code_round            = Input::get('code_round');
                            $item->results_received      = Input::get('results_received')? '1' : '0';
                            $item->code_test   = $ct->code;
                            $item->question1   = Input::get('question1_'.$ct->code)? '1' : '0';
                            $item->question2   = Input::get('question2_'.$ct->code)? '1' : '0';
                            $item->save();
                        }


                    }
                    $message = [
                        'flashType'    => 'success',
                        'flashMessage' => 'Round aggiunto con successo!'
                    ];

                } catch (\Exception $e) {
                    //log
                    $message = [
                        'flashType'    => 'danger',
                        'flashMessage' => 'Errore! Controllare i dati di inserimento del Round'
                    ];
                }
            }
        }
        //return redirect()->route('round.index')->with($message);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
