<?php

use Illuminate\Database\Seeder;
use App\Secretaire;
use Illuminate\Support\Facades\Hash;

class secretaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Secretaire::create([
            'Nom'   =>  'Smith',
            'Prenom'    =>  'Jhon',
            'Adresse'      =>   '12 rue ziz,Agadir',
            'Tel'   =>  '0696857415',
            'Email' =>  'Secretaire1@localhost.com',
            'Pseudo'    => 'secretaire' ,
            'password'   => Hash::make("password") ,
            'Token' =>  null,
            'remember_token'    =>  null,
            'DernierLog'    =>  null,
            'created_at'    => date('Y-m-d H:m:s')
        ]);
    }
}