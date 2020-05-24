<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperationsSelonConsultationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operations__selon__Consultation', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ConsultationID')->unsigned();
            $table->bigInteger('OperationId')->unsigned();
            $table->foreign('OperationId')->references('id')->on('operations__cabinets')->onDelete('cascade');
            $table->foreign('ConsultationID')->references('id')->on('consultations')->onDelete('cascade');
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operations__selon__factures');
    }
}