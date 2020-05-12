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
            $table->bigInteger('PatientId')->unsigned();
            $table->timestamp('dateArrive')->useCurrent();
            $table->boolean('passe')->default(false);
            $table->boolean('Urgent')->default(false);
            
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
        Schema::dropIfExists('salle_attentes');
    }
}