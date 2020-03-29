<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLettresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lettres', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('Recepteur')->unsigned();
            $table->bigInteger('Destinataire')->unsigned();
            $table->timestamp('Date')->useCurrent();
            $table->longText('Message')->nullable();
            $table->bigInteger('ConsultationId')->unsigned();
            $table->boolean('Vue');
            $table->longText('Fichiers')->nullable();

            $table->foreign('Recepteur')->references('id')->on('medcins')->onDeletes('cascade');
            $table->foreign('Destinataire')->references('id')->on('medcins')->onDeletes('cascade');
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
        Schema::dropIfExists('lettres');
    }
}