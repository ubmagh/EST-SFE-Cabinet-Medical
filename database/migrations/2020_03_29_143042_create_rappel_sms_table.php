<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRappelSmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rappel_sms', function (Blueprint $table) {
            $table->id();
            $table->timestamp('DateEnvoi')->useCurrent();
            $table->bigInteger('RdvId')->unsigned();

            $table->foreign('RdvId')->references('id')->on('rendezvouses')->onDeletes('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rappel_sms');
    }
}