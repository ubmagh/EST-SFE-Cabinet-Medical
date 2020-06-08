<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLettreAuConfreresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lettre_au_confreres', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ConfrereID')->unsigned();
            $table->string('Titre');
            $table->longText('Message')->nullable();
            $table->timestamp('date')->UseCurrent();
            $table->bigInteger('MedcinId')->unsigned();
            $table->bigInteger('PatientId')->unsigned()->nullable();

            $table->foreign('PatientId')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('ConfrereID')->references('id')->on('confreres')->onDelete('cascade');
            $table->foreign('MedcinId')->references('id')->on('medcins');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lettre_au_confreres');
    }
}