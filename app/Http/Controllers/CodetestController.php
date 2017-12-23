<?php

namespace App\Http\Controllers;

use App\CodeTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class CodetestController extends Controller
{
    public function index()
    {
        try {
          $tests = CodeTest::all();
        } catch (\Exception $e) {
            $message = [
                'flashType'    => 'danger',
                'flashMessage' => 'Errore! CodeTest'
            ];
        }
        return view('admin.codetest.index', compact('tests'));
    }


    /**
     * Update Lab in storage.
     *
     * @param    $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePrice(Request $request)
    {
        $inputData  = Input::all(); //echo "<pre>"; print_r($inputData); exit;

        if(!empty($inputData) && count($inputData)> 0) {
            foreach($inputData as $column => $value)
            {
                if($value!=null)
                    CodeTest::where('code', $column)->update(['price' => $value]);
            }

            $message = [
                'flashType'    => 'success',
                'flashMessage' => 'I prezzi dei tests sono stati aggiornati correttamente',
                'mode'=>'edit'
            ];
        }

        return back()->withInput()->with($message);
    }
}
