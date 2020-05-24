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
            $table->timestamp('Date')->useCurrent();
            $table->string('Type',20);
            $table->longText('Description')->nullable();
            $table->bigInteger('PatientId')->unsigned();
            $table->bigInteger('MedcinId')->unsigned();
            $table->boolean('Urgent');
            $table->longText('ExamensAfaire')->nullable();
            $table->foreign('PatientId')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('MedcinId')->references('id')->on('medcins')->onDelete('cascade');


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