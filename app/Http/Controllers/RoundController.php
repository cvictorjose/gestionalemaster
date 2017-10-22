<?php

namespace App\Http\Controllers;

use App\CodeTest;
use App\Round;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class RoundController extends Controller
{

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
            $labs = Round::select('code_round','laboratory_id')->distinct()->get();

            
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
        $inputData  = Input::all(); //echo "<pre>"; print_r($inputData); //exit;
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
                    $test_spuntati=0;
                    foreach ($code_test as $ct){
                        $test_active  = (Input::get($ct->code))? 1 : 0;
                        if ($test_active == 1){

                            $checkData= array(
                                'test' =>$ct->code,
                                'lab'  =>Input::get('laboratory_id'),
                                'round'=>Input::get('code_round')
                            );

                            $checkData2=Round::TestChecked($checkData);

                            echo $checkData2;

                            if ($checkData2<1){

                                $test_spuntati=1;
                                $item = new Round();
                                $item->laboratory_id         = Input::get('laboratory_id');
                                $item->code_round            = Input::get('code_round');
                                $item->results_received      = Input::get('results_received')? '1' : '0';
                                $item->code_test   = $ct->code;
                                $item->question1   = Input::get('question1_'.$ct->code)? '1' : '0';
                                $item->question2   = Input::get('question2_'.$ct->code)? '1' : '0';
                                $item->save();
                            }else{
                                $message = [
                                    'flashType'    => 'danger',
                                    'flashMessage' => 'Il Code Test spuntato esiste gia sul DB'
                                ];
                                return back()->withInput()->with($message);
                            }
                        }
                    }

                    if ($test_spuntati<1)
                        $message = [
                            'flashType'    => 'danger',
                            'flashMessage' => 'Devi spuntare almeno 1 Test'
                        ];

                    $message = [
                        'flashType'    => 'success',
                        'flashMessage' => 'Round aggiunto con successo!'
                    ];

                    return back()->withInput()->with($message);

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
     * Remove Round from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyRound()
    {
        $inputData  = Input::all(); //echo "<pre>"; print_r($inputData); //exit;
        $lab_id=$inputData['lab_id'];
        $lab_round=$inputData['lab_round'];

       try {
          $data = Round::where('laboratory_id',$lab_id)->Where('code_round', $lab_round)->get();
           foreach ($data as $d){
               $d->delete();
           }
            return redirect()->route('round_labs');
        } catch (Exception $e) {
            //log
        }
    }
}
