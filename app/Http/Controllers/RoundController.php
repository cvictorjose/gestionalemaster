<?php

namespace App\Http\Controllers;

use App\CodeTest;
use App\Laboratory;
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

            $rounds=array();
            $round = Round::select('code_round')->distinct()->where('status',1)->get();

            foreach($round as $r){
                $item= new \stdClass();
                $item->id ="";
                $item->code_round ="";
                $item->total ="";

                $lab   = Round::select('laboratory_id')->where('code_round',$r->code_round)->distinct()->get();

                $item->id = $r->laboratory_id;
                $item->code_round = $r->code_round;
                $item->total = count($lab);
                $rounds[]=$item;
            }
        } catch (\Exception $e) {
            $message = [
                'flashType'    => 'danger',
                'flashMessage' => 'Errore! Laboratorio'
            ];
        }
       // return Round::getRoundsPrecedenti('RF0916');
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
            $inputData  = Input::all(); //echo "<pre>"; print_r($inputData); //exit;
            $round=$inputData['round_id'];

            $data   = Round::select('laboratory_id')->where('code_round',$round)->distinct()->get();

            $labs=array();
            foreach ($data as $l){
                $icar= Laboratory::find($l->laboratory_id);
                $pcNew=new \stdClass();
                $pcNew->code_round    = $round;
                $pcNew->laboratory_id = $l->laboratory_id;
                $pcNew->icar_code     = $icar->icar_code;
                $pcNew->lab_name      = $icar->lab_name;
                $labs[]=$pcNew;
            }

        } catch (\Exception $e) {
            $message = [
                'flashType'    => 'danger',
                'flashMessage' => 'Errore! Laboratorio'
            ];
        }
       return view('admin.round.labs', compact('labs','round'));
    }


    /**
     * Load all Test of single Lab
     *
     * @return \Illuminate\Http\Response
     */
    public function roundLabTest()
    {
        try {
            $inputData  = Input::all(); //echo "<pre>"; print_r($inputData); //exit;
            $lab_id=$inputData['lab_id'];
            $lab_round=$inputData['lab_round'];
            $lab_name=$inputData['lab_name'];

           $labs = Round::where('laboratory_id',$lab_id)->Where('code_round', $lab_round)->get();
        } catch (\Exception $e) {
            $message = [
                'flashType'    => 'danger',
                'flashMessage' => 'Errore! Laboratorio'
            ];
        }
        return view('admin.round.lab_test', compact('labs','lab_round','lab_name'));
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
                'code_round'      => 'required|min:4|max:10',
            ];

            $messages = [
                'required' => 'Controllare tutti i campi obbligatori (*).',
                'unique'   => 'Il codice del laboratorio esiste sul DB',
                'max'      => 'Code Round deve avere massimo 10 digiti',
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

                            $receive_date=Input::get('date');
                            if ($checkData2<1){
                                $test_spuntati=1;
                                $item = new Round();
                                $item->laboratory_id         = Input::get('laboratory_id');
                                $item->code_round            = Input::get('code_round');
                                $item->results_received      = Input::get('results_received')? '1' : '0';
                                $item->results_received_date = $receive_date;
                                $item->code_test   = $ct->code;
                                $item->question1   = Input::get('question1_'.$ct->code)? '1' : '0';
                                $item->question2   = Input::get('question2_'.$ct->code)? '1' : '0';
                                $item->status   = 1;
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
           $message = [
               'flashType'    => 'success',
               'flashMessage' => 'Laboratorio eliminato con successo!'
           ];
           return redirect()->route('round.index')->with($message);
        } catch (Exception $e) {
            //log
        }
    }

    /**
     * Remove Round from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroySingleTest()
    {
        $inputData  = Input::all(); //echo "<pre>"; print_r($inputData); //exit;
        $id=$inputData['lab_id'];

        try {
            $t = Round::find($id);
            $t->delete();
            $message = [
                'flashType'    => 'success',
                'flashMessage' => 'Test eliminato con successo!'
            ];
            return redirect()->route('round_labs')->withInput($inputData)->with($message);

        } catch (Exception $e) {
            //log
        }
    }


    public function dropdown($lab_id)
    {
        $rounds= Round::where('laboratory_id',$lab_id)->groupBy('code_round')->get();
        $lastRound="";
        $clean_rounds=$lastRound= array();
        foreach ($rounds as $r){
            $numbers = substr($r->code_round, 2, 4);
           if (!in_array($numbers,$lastRound)){
               $n= new \stdClass();
               $n->code_round= $numbers;
               $clean_rounds[]=$n;
               $lastRound[]=$numbers;
           }
        }
        return $clean_rounds;
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
            $inputData  = Input::all(); //echo "<pre>"; print_r($inputData); //exit;
            $lab_id=$inputData['lab_id'];
            $lab_round=$inputData['lab_round'];

            $result = Round::where('laboratory_id',$lab_id)->Where('code_round', $lab_round)->get();
            //return $result;
            $round= new \stdClass();
            foreach ($result as $r){
                $round->laboratory_id               = $r->laboratory_id;
                $round->code_round                  = $r->code_round;
                $round->results_received            = $r->results_received;
                $round->results_received_date       = $r->results_received_date;

                $tt= new \stdClass();
                $tt->test=$r->code_test;
                $tt->q1=$r->question1;
                $tt->q2=$r->question2;
                $round->test[] = $tt;
            }

            $tests = CodeTest::all();
          // return response()->json($round);

        } catch (\Exception $e) {
            $message = [
                'flashType'    => 'danger',
                'flashMessage' => 'Errore! Modifica Round'
            ];
        }
        $lab= Laboratory::find($lab_id);
        return view('admin.round.edit', compact('round','tests','lab'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$laboratory_id)
    {
        try {
            $inputData  = Input::all();  //echo "<pre>"; print_r($inputData); exit;
            $code_round=$inputData['code_round'];

            $round = Round::where('laboratory_id',$laboratory_id)->Where('code_round', $code_round)->delete();
            $tests= CodeTest::where('status','1')->get(['code']);
            foreach ($tests as $ct){
                $test_active  = (Input::get($ct->code))? 1 : 0;
                if ($test_active == 1){
                    $receive_date=Input::get('date');
                    $item = new Round();
                    $item->laboratory_id         = Input::get('laboratory_id');
                    $item->code_round            = Input::get('code_round');
                    $item->results_received      = Input::get('results_received')? '1' : '0';
                    $item->results_received_date = $receive_date;
                    $item->code_test   = $ct->code;
                    $item->question1   = Input::get('question1_'.$ct->code)? '1' : '0';
                    $item->question2   = Input::get('question2_'.$ct->code)? '1' : '0';
                    $item->status   = 1;
                    //  print_r(json_decode($item)) ;
                    $item->save();
                }
            }

            $message = [
                'flashType'    => 'success',
                'flashMessage' => 'Round aggiornato con successo!'
            ];

            $lab= Laboratory::find(Input::get('laboratory_id'));
            $result = Round::where('laboratory_id',Input::get('laboratory_id'))->Where('code_round', $code_round)->get();
            $round= new \stdClass();
            foreach ($result as $r){
                $round->laboratory_id               = $r->laboratory_id;
                $round->code_round                  = $r->code_round;
                $round->results_received            = $r->results_received;
                $round->results_received_date       = $r->results_received_date;

                $tt= new \stdClass();
                $tt->test       = $r->code_test;
                $tt->q1         = $r->question1;
                $tt->q2         = $r->question2;
                $round->test[]  = $tt;
            }

            return view('admin.round.edit', compact('round','tests','lab'))->with($message);
          //  return view('admin.round.edit', ['round' => $round,'tests'=>$tests,'lab'=>$lab,'message'=>$message]);
        } catch (Exception $e) {
            //log
        }
    }
}
