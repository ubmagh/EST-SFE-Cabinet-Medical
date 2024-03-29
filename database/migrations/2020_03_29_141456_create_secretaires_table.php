<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecretairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secretaires', function (Blueprint $table) {
            $table->id();
            $table->string('Nom',30);
            $table->string('Prenom',30);
            $table->string('Adresse',100)->nullable();
            $table->string('Tel',14);
            $table->string('Email',100)->unique();
            $table->string('Pseudo',20)->unique();
            $table->text('password');
            $table->text('remember_token')->nullable();
            $table->json('DernierLog')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('secretaires');
    }
}