<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicamentParOrdonnancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicament_par_ordonnances', function (Blueprint $table) {
            $table->id();
            $table->bigInteger( 'MedicamentId')->unsigned();
            $table->bigInteger( 'OrdonnanceId')->unsigned();
            $table->string('Periode',20)->nullable(); ///Duree \
            $table->integer('NbrParJour')->nullable();

        $table->foreign('MedicamentId')->references('id')->on('medicaments')->onDelete('cascade');
        $table->foreign('OrdonnanceId')->references('id')->on('ordonnances');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicament_par_ordonnances');
    }
}