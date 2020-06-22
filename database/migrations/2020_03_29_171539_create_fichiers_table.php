<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFichiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fichiers', function (Blueprint $table) {
            $table->id();
            $table->timestamp('Date')->useCurrent();
            $table->string('Type',30);
            $table->string('CurrentName');/// contains name and extension of stored file
            $table->string('OriginalName');// Name to return to user in Download 
            $table->bigInteger('Size');
            $table->bigInteger('ConsultationId')->unsigned();

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
        Schema::dropIfExists('fichiers');
    }
}