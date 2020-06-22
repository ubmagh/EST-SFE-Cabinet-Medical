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
            'Adresse'      =>   '12 hay al Quds, Agadir',
            'Tel'   =>  '0696857455',
            'Email' =>  'Secretaire1@localhost.com',
            'Pseudo'    => 'secretaire1' ,
            'password'   => Hash::make("password") ,
            'remember_token'    =>  null,
            'DernierLog'    =>  json_encode(['last'=>'','first'=>'']) ,
            'created_at'    => date('Y-m-d H:i:s')
        ]);
        Secretaire::create([
            'Nom'   =>  'Costa',
            'Prenom'    =>  'Alex',
            'Adresse'      =>   '13 Imeuble Idrissi rue Farah, agadir',
            'Tel'   =>  '0696857415',
            'Email' =>  'Secretaire2@localhost.com',
            'Pseudo'    => 'secretaire2' ,
            'password'   => Hash::make("password") ,
            'remember_token'    =>  null,
            'DernierLog'    =>  json_encode(['last'=>'','first'=>'']) ,
            'created_at'    => date('Y-m-d H:i:s')
        ]);
    }
}