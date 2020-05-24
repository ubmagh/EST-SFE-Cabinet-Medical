<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalyseDemandeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analyse_demandees', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ConsultationId')->unsigned();
            $table->date('DemandeLe');
            $table->date('ARendreLe')->nullable();
            $table->string('Titre',70);
            $table->longText('Description');
            $table->date('RenduLe');

            $table->foreign('ConsultationId')->references('id')->on('consultations')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('analyse_demandees');
    }
}