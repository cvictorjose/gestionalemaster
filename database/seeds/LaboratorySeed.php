<?php

use App\Laboratory;
use Illuminate\Database\Seeder;

class LaboratorySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('laboratory')->delete();
        DB::statement("ALTER TABLE `users` AUTO_INCREMENT = 1;");
        factory(Laboratory::class, 3)->create();
    }
}
