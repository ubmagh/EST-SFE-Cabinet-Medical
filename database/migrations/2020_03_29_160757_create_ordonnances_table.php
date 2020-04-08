<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdonnancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordonnances', function (Blueprint $table) {
            $table->id();
        $table->date('Date');
        $table->bigInteger( 'ConsultationId')->unsigned();
        $table->string('Periode',20)->nullable(); ///Duree \
        $table->integer('NbrParJour');
        $table->longText( 'Remarques')->nullable();
        $table->longText( 'Allergies')->nullable();
        $table->longText( 'Antecedants')->nullable();
        $table->foreign('ConsultationId')->references('id')->on('consultations')->onDeletes('cascade');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordonnances');
    }
}