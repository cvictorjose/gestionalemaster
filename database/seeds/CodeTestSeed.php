<?php

use App\CodeTest;
use Illuminate\Database\Seeder;

class CodeTestSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list_code = array(
            1 => array('name'=>'fat_ref'),
            2 => array('name'=>'protein_ref'),
            3 => array('name'=>'lactose_ref'),
            4 => array('name'=>'urea_ref'),
            5 => array('name'=>'scc_ref'),
            6 => array('name'=>'fat_rout'),
            7 => array('name'=>'protein_rout'),
            8 => array('name'=>'lactose_rout'),
            9 => array('name'=>'urea_rout'),
            10=> array('name'=>'bhb'),
            11=> array('name'=>'pag'),
        );
        for($s = 1; $s < 12; $s++) {
            CodeTest::create([
                'code'  => $list_code[$s]['name']
            ]);
        }
    }
}
