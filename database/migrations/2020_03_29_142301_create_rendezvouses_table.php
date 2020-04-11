<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRendezvousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rendezvouses', function (Blueprint $table) {
            $table->id();
            $table->date('Date');
            $table->time('Heure');
            $table->bigInteger('PatientId')->unsigned();
            $table->string('Description')->nullable();
            $table->bigInteger('SecretaireId')->unsigned();
            $table->string('Statut',30);
            
            $table->foreign('PatientId')->references('id')->on('Patients')->onDelete('cascade');
            $table->foreign('SecretaireId')->references('id')->on('Secretaires')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rendezvouses');
    }
}