<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalleAttentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salle_attentes', function (Blueprint $table) {
            $table->id();
            $table->timestamp('DateArrive')->useCurrent();
            $table->bigInteger('PatientId')->unsigned();
            //$table->boolean('passe')->default(false);
            $table->bigInteger('ConsultationID')->unsigned()->nullable(); 
            $table->bigInteger('rdvID')->unsigned()->nullable();
            $table->bigInteger('SecretaireID')->unsigned();
            $table->boolean('Urgent')->default(false);
            $table->boolean('Quitte')->default(false);
            $table->time('startTime')->nullable()->default(null);
            
        $table->foreign('PatientId')->references('id')->on('patients')->onDelete('cascade');
        $table->foreign('ConsultationID')->references('id')->on('consultations')->onDelete('cascade');
        $table->foreign('rdvID')->references('id')->on('rendezvouses')->onDelete('cascade');
        $table->foreign('SecretaireID')->references('id')->on('secretaires')->onDelete('cascade');
    });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salle_attentes');
    }
}