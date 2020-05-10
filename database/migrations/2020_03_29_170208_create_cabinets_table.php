<?php

use App\Cabinet;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateCabinetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cabinets', function (Blueprint $table) {
            $table->id();
            $table->string('Nom',100);
            $table->string('Adresse',255)->nullable();
            $table->string('logo')->nullable();
            $table->string('Specialites')->nullable();
            $table->string('Description')->nullable();
            $table->string('Tel',14)->nullable();
            $table->string('Email',100)->nullable();
            $table->string('Fax',14)->nullable();
            $table->string('AdminPseudo',20);
            $table->longText('password');
            $table->string('AdminEmail',100);
            $table->longText('AdminToken')->nullable();
            $table->text('remember_token')->nullable();
            $table->json('AdminLastLogin')->nullable();
        });

        Cabinet::create([
            'Nom'   =>  'Cabinet Alfarah',
            'Adresse'   =>  ' 12, Rue ziz, Agadir ',
            'logo'  =>  'Cabinet-Default-logo.png',
            'Specialites'   =>  ' Dentist ',
            'Description'   =>  ' Cabinet Medical ',
            'Tel'   =>  '0600000000',
            'Email'   =>  'Contact@AlfarahCabinet.info',
            'Fax'   =>  '0500000000',
            'AdminPseudo'   =>  'admin',
            'password'   =>  Hash::make('password'),
            'AdminEmail'    =>  'admin@localhost.com',
            'AdminToken'    =>  null,
            'remember_token'    =>  null,
            'AdminLastLogin'    =>  json_encode(['last'=>'','first'=>''])

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cabinets');
    }
}