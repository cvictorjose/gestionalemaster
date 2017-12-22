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

            $table->string('nominativo_contatto');
            $table->string('email');

            $table->string('spedizione_address');
            $table->string('spedizione_cap');
            $table->string('spedizione_city');
            $table->string('spedizione_country');
            $table->string('ente_associato');

            $table->string('contatto_amministrativo');
            $table->string('email_amministrativa');
            $table->string('invoice_address');
            $table->string('invoice_cap');
            $table->string('invoice_city');
            $table->string('invoice_country');
            $table->string('vat_number');
            $table->string('participation_fee');
            $table->string('shipment_cost');
            $table->string('invoicetype');


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
