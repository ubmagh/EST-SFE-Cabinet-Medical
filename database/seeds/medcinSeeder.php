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
            'Nom'   =>  'scott',
            'Prenom'    =>  'lara',
            'Specialite'    =>  'Dentist',
            'Signature' =>  null,
            'Adresse'      =>   '13 rue ziz,Agadir',
            'Tel'   =>  '0687542150',
            'Email' =>  'Medcin1@localhost.com',
            'Pseudo'    => 'medcin' ,
            'password'   => Hash::make("password") ,
            'remember_token'    =>  null,
            'PrixDeConsultation'    => 100,
            'DernierLog'    =>  json_encode(['last'=>'','first'=>'']),
            'created_at'    => date('Y-m-d H:i:s')
        ]);
    }
}