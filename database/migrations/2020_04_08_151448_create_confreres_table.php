<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfreresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('confreres', function (Blueprint $table) {
            $table->id();
            $table->string("Nom",50);
            $table->string("Tel",14)->nullable();
            $table->string('Fax',14)->nullable();
            $table->string("Email",90)->nullable();
            $table->string("adresse",50);
            $table->string("Ville",40);
            $table->string("Specialite",50);
            $table->timestamp("date_ajout")->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('confreres');
    }
}