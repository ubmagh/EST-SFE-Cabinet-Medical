<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperationsSelonFacturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operations__selon__factures', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('FactureId')->unsigned();
            $table->bigInteger('OperationId')->unsigned();

            $table->foreign('OperationId')->references('id')->on('operations__cabinets')->onDeletes('cascade');
            $table->foreign('FactureId')->references('id')->on('factures')->onDeletes('cascade');
            
            
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