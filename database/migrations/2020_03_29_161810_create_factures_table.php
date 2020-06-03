<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ConsultationId')->unsigned()->nullable();
            $table->string('Motif',100);
            $table->date('Date')->useCurrent();
            $table->decimal('Somme');
            $table->decimal('Paye')->default(0);
            $table->decimal('Remise')->default(0);

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
        Schema::dropIfExists('factures');
    }
}