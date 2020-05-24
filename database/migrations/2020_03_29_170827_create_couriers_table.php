<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouriersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('couriers', function (Blueprint $table) {
            $table->id();
            $table->string('Email_Ext',100);///  1->email de destinateur    2-> email de destinataire
            $table->bigInteger('SecretaireID')->unsigned()->nullable(); /// 1-> celui est null    2->id secretiare
            $table->string('Nom',60);
            $table->string('Objet',60);
            $table->longText('Message');
            $table->timestamp('Date')->useCurrent();
            $table->longText('Fichiers')->nullable();

            $table->foreign('SecretaireID')->references('id')->on('secretaires')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('couriers');
    }
}