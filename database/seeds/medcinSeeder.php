<?php

use Illuminate\Database\Seeder;
use App\Medcin;
use Illuminate\Support\Facades\Hash;

class medcinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Medcin::create([
            'Nom'   =>  'Bacha',
            'Prenom'    =>  'Abdellatif',
            'Specialite'    =>  'Dentist',
            'Signature' =>  null,
            'Adresse'      =>   '13 rue ziz, Agadir',
            'Tel'   =>  '0687542150',
            'Email' =>  'Medcin1@localhost.com',
            'Pseudo'    => 'medecin1' ,
            'password'   => Hash::make("password") ,
            'remember_token'    =>  null,
            'PrixDeConsultation'    => 100,
            'DernierLog'    =>  json_encode(['last'=>'','first'=>'']),
            'created_at'    => date('Y-m-d H:i:s')
        ]);
        Medcin::create([
            'Nom'   =>  'Ben Ali',
            'Prenom'    =>  'Meryem',
            'Specialite'    =>  'Dentist',
            'Signature' =>  null,
            'Adresse'      =>   '6 rue Hassan 2, Agadir',
            'Tel'   =>  '0687542220',
            'Email' =>  'Medcin2@localhost.com',
            'Pseudo'    => 'medecin2' ,
            'password'   => Hash::make("password") ,
            'remember_token'    =>  null,
            'PrixDeConsultation'    => 95,
            'DernierLog'    =>  json_encode(['last'=>'','first'=>'']),
            'created_at'    => date('Y-m-d H:i:s')
        ]);
    }
}