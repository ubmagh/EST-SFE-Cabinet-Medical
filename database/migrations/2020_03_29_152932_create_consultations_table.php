<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->string('Type',20);
            $table->longText('Description')->nullable();
            $table->bigInteger('PatientId')->unsigned();
            $table->bigInteger('MedcinId')->unsigned();
            $table->bigInteger('SecretaireId')->unsigned();
            $table->boolean('Urgent');
            $table->longText('ExamensAfaire')->nullable();
            // on va ajouter aussi les confrères recommandés
            $table->foreign('PatientId')->references('id')->on('patients')->onDeletes('cascade');
            $table->foreign('MedcinId')->references('id')->on('medcins')->onDeletes('cascade');
            $table->foreign('SecretaireId')->references('id')->on('Secretaires')->onDeletes('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultations');
    }
}