<?php

use App\Patient;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string("id_civile",30)->unique();
            $table->string("Nom",30);
            $table->string("Prenom",30);
            $table->string("Tel",14)->nullable();
            $table->string("Email",90)->nullable();
            $table->string("Sexe",6);
            $table->string("adresse",50)->nullable();
            $table->string("Ville",40)->nullable();
            $table->date('DateNaissance')->nullable();
            $table->string('Occupation',20)->nullable();
            $table->string("Nationnalite",60)->nullable();
            $table->string('typeMutuel',40)->nullable();
            $table->string('ref_mutuel')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
        Patient::create([
            'id_civile' =>  'JC1111111',
            'Nom'   =>  'Sendid',
            'Prenom'    =>  'Omar',
            'Tel'   =>  null,
            'Email' =>  null,
            'Sexe'  =>  'homme',
            'adresse'   =>  'tigmi ',
            'Ville' =>  'Agadir',
            'DateNaissance' =>  '2000-01-01',
            'Occupation'    =>  'Etudiant',
            'Nationnalite'  =>  'Maroc',
            'typeMutuel'    =>  'CNSS',
            'ref_mutuel'    =>  'aBC15454545'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}