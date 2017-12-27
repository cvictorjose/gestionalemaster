<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaboratoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laboratory', function (Blueprint $table) {
            $table->increments('id');
            $table->string('icar_code')->unique();
            $table->string('lab_name');
            $table->integer('status')->default(0);

            $table->string('nominativo_contatto')->nullable();
            $table->string('email')->nullable();

            $table->string('spedizione_address')->nullable();
            $table->string('spedizione_cap')->nullable();
            $table->string('spedizione_city')->nullable();
            $table->string('spedizione_country')->nullable();
            $table->string('ente_associato')->nullable();

            $table->string('contatto_amministrativo')->nullable();
            $table->string('email_amministrativa')->nullable();
            $table->string('invoice_address')->nullable();
            $table->string('invoice_cap')->nullable();
            $table->string('invoice_city')->nullable();
            $table->string('invoice_country')->nullable();
            $table->string('vat_number')->nullable();
            $table->string('participation_fee')->nullable();
            $table->string('shipment_cost')->nullable();
            $table->string('invoicetype')->nullable();


            $table->integer('fat_ref')->default(0);
            $table->integer('protein_ref')->default(0);
            $table->integer('lactose_ref')->default(0);
            $table->integer('urea_ref')->default(0);
            $table->integer('scc_ref')->default(0);
            $table->integer('fat_rout')->default(0);
            $table->integer('protein_rout')->default(0);
            $table->integer('lactose_rout')->default(0);
            $table->integer('urea_rout')->default(0);
            $table->integer('bhb')->default(0);
            $table->integer('pag')->default(0);
            $table->integer('dna')->default(0);

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
        Schema::dropIfExists('laboratory');
    }
}
