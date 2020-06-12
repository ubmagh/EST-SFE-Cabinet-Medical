<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    /*
    public function up()
    {
        Schema::create('certificats', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('PatientId')->unsigned();
            $table->string('Motif');
            $table->string( 'Type',30);
            $table->string('Duree',30)->nullable();

            $table->foreign('PatientId')->references('id')->on('patients')->onDeletes('cascade');
            

        });
    }*/
    public function up()
    {
        Schema::create('certificats', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('PatientId')->unsigned();
            $table->string('Motif');
            $table->string( 'Type',30);
            $table->string('Duree',30)->nullable();

            $table->foreign('PatientId')->references('id')->on('patients')->onDeletes('cascade');
            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificats');
    }
}