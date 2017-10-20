<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoundTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('round', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('laboratory_id')->length(10)->unsigned()->nullable();
            $table->foreign('laboratory_id')->references('id')->on('laboratory')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->string('code_round')->length(6);
            $table->integer('results_received')->default(0);

            $table->timestamp('results_received_date')->useCurrent();

            $table->string('code_test')->length(50);
            $table->integer('question1')->default(0);
            $table->integer('question2')->default(0);

            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('round');
    }
}
