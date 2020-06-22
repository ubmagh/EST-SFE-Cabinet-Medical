<?php

use Illuminate\Database\Seeder;
use App\Patient;

class patientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $array = [
            [
                'id_civile' =>  'JC000001',
                'Nom'   =>  'Sendid',
                'Prenom'    =>  'Omar',
                'Tel'   =>  "0612345678",
                'Email' =>  "omar@gmail.com",
                'Sexe'  =>  'homme',
                'adresse'   =>  ' 12 Rue ziz ',
                'Ville' =>  'Agadir',
                'DateNaissance' =>  '2000-01-01',
                'Occupation'    =>  'Etudiant',
                'Nationnalite'  =>  'Marocain',
                'typeMutuel'    =>  'CNSS',
                'ref_mutuel'    =>  'BC15454545',
                'created_at'    =>  "2015-06-21 10:27:07"
            ],[
                'id_civile' =>  'JC000002',
                'Nom'   =>  'Ait moha',
                'Prenom'    =>  'Ali',
                'Tel'   =>  "0612345679",
                'Email' =>  "ali@gmail.com",
                'Sexe'  =>  'homme',
                'adresse'   =>  ' 13 Rue ziz ',
                'Ville' =>  'Marrakech',
                'DateNaissance' =>  '1999-12-08',
                'Occupation'    =>  'Etudiant',
                'Nationnalite'  =>  'Marocain',
                'typeMutuel'    =>  'FAR',
                'ref_mutuel'    =>  'WYX4897320',
                'created_at'    =>  "2016-01-10 10:27:07"
            ],[
                'id_civile' =>  'JC000003',
                'Nom'   =>  'Ait moha',
                'Prenom'    =>  'Aicha',
                'Tel'   =>  "0612345670",
                'Email' =>  "Aicha@gmail.com",
                'Sexe'  =>  'femme',
                'adresse'   =>  ' hay al amal Drargua ',
                'Ville' =>  'Agadir',
                'DateNaissance' =>  '1986-10-22',
                'Occupation'    =>  'Femme de ménage',
                'Nationnalite'  =>  'Marocain',
                'typeMutuel'    =>  null,
                'ref_mutuel'    =>  null,
                'created_at'    =>  "2015-06-21 11:27:07"
            ],[
                'id_civile' =>  'JC000004',
                'Nom'   =>  'Maghdaoui',
                'Prenom'    =>  'Ayoub',
                'Tel'   =>  "0612345689",
                'Email' =>  "Ayoub@gmail.com",
                'Sexe'  =>  'homme',
                'adresse'   =>  ' Ouled Berhil ',
                'Ville' =>  'Taroudant',
                'DateNaissance' =>  '2000-07-17',
                'Occupation'    =>  'Etudiant',
                'Nationnalite'  =>  'Marocain',
                'typeMutuel'    =>  "CNSS",
                'ref_mutuel'    =>  "43CPX13028",
                'created_at'    =>  "2018-08-08 10:27:07"
            ],
            [
                'id_civile' => 'PR865183',
                'Nom' => 'ID Brahim',
                'Prenom' => 'Ahmed',
                'Tel' => '0648578127',
                'Email' => 'Ahmed@ask.com',
                'Sexe' => 'homme',
                'adresse' => ' 32 rue lboustane ',
                'Ville' => 'Fes',
                'DateNaissance' => '1978-04-16',
                'Occupation' => 'Ingénieur',
                'Nationnalite' => "Marocain",
                'typeMutuel' => "CNSS",
                'ref_mutuel' => "BTX6548X7220",
                'created_at'    =>  "2018-08-11 17:27:07"
            ],
            [
                'id_civile' => 'GK950470',
                'Nom' => 'Jalal',
                'Prenom' => 'Abderahim',
                'Tel' => '0639838712',
                'Email' => 'Jalal@fotki.com',
                'Sexe' => 'homme',
                'adresse' => '3 Hay agoudal',
                'Ville' => 'Rabat',
                'DateNaissance' => '2007-12-17',
                'Occupation' => null,
                'Nationnalite' => "Marocain",
                'typeMutuel' => true,
                'ref_mutuel' => true,
                'created_at'    =>  "2019-10-10 15:27:07"
            ],
            [
                'id_civile' => 'AS945231',
                'Nom' => 'Qaddour',
                'Prenom' => 'Ibrahim',
                'Tel' => '0627340141',
                'Email' => 'Brahimi@printfriendly.com',
                'Sexe' => 'homme',
                'adresse' => null,
                'Ville' => 'Safi',
                'DateNaissance' => '1989-10-19',
                'Occupation' => 'Retraité',
                'Nationnalite' => "Marocain",
                'typeMutuel' => "RAMED",
                'ref_mutuel' => "LPCI18014850",
                'created_at'    =>  "2019-10-27 16:27:07"
            ],
            [
                'id_civile' => 'DQ764179',
                'Nom' => 'Fido',
                'Prenom' => 'Sara',
                'Tel' => '0672937208',
                'Email' => 'Sara@blogger.com',
                'Sexe' => 'femme',
                'adresse' => '91 Hotel Sahara',
                'Ville' => 'Agadir',
                'DateNaissance' => '1971-06-23',
                'Occupation' => 'Tourisme',
                'Nationnalite' => "Française",
                'typeMutuel' => null,
                'ref_mutuel' => null,
                'created_at'    =>  "2015-06-21 10:27:07"
            ],
            [
                'id_civile' => 'DO335258',
                'Nom' => 'Ait Bihi',
                'Prenom' => 'Meryem',
                'Tel' => '0605078084',
                'Email' => 'Merym@unc.edu',
                'Sexe' => 'femme',
                'adresse' => null,
                'Ville' => 'Agadir',
                'DateNaissance' => '1981-09-22',
                'Occupation' => 'Professeur',
                'Nationnalite' => "Marocain",
                'typeMutuel' => "CNSS",
                'ref_mutuel' => "BMXA1574720",
                'created_at'    =>  "2020-03-21 10:27:07"
            ],
            [
                'id_civile' => 'BE436891',
                'Nom' => 'BERAMIN',
                'Prenom' => 'Yassine',
                'Tel' => '0690996816',
                'Email' => 'mberndt7@cornell.edu',
                'Sexe' => 'femme',
                'adresse' => '3 Dayton Junction',
                'Ville' => 'Zhongyuan',
                'DateNaissance' => '2004-11-29',
                'Occupation' => 'Chauffeur',
                'Nationnalite' => "Marocain",
                'typeMutuel' => null,
                'ref_mutuel' => null,
                'created_at'    =>  "2020-04-29 10:27:07"
            ],
            [
                'id_civile' => 'BQ281410',
                'Nom' => 'Crab',
                'Prenom' => 'Helsa',
                'Tel' => '0630213146',
                'Email' => 'hcrab8@psu.edu',
                'Sexe' => 'femme',
                'adresse' => '2 Gerald Way',
                'Ville' => 'La Esperanza',
                'DateNaissance' => '1992-03-11',
                'Occupation' => null,
                'Nationnalite' => null,
                'typeMutuel' => null,
                'ref_mutuel' => null,
                'created_at'    =>  "2020-06-10 10:27:07"
            ],
            [
                'id_civile' => 'FV666423',
                'Nom' => 'Franzelini',
                'Prenom' => 'Marshall',
                'Tel' => '0691883350',
                'Email' => 'mfranzelini9@privacy.gov.au',
                'Sexe' => 'homme',
                'adresse' => '0709 Brickson Park Pass',
                'Ville' => 'Ath',
                'DateNaissance' => '2006-05-29',
                'Occupation' => null,
                'Nationnalite' => null,
                'typeMutuel' => null,
                'ref_mutuel' => null,
                'created_at'    =>  "2020-06-15 10:27:07"
            ],
            [
                'id_civile' => 'FK666423',
                'Nom' => 'Rakim',
                'Prenom' => 'Sana',
                'Tel' => '0691783350',
                'Email' => 'Rakimi@privacy.au',
                'Sexe' => 'femme',
                'adresse' => '0709 Brickson Park Pass',
                'Ville' => 'Agadir',
                'DateNaissance' => '2006-05-29',
                'Occupation' => null,
                'Nationnalite' => "Marocaine",
                'typeMutuel' => null,
                'ref_mutuel' => null,
                'created_at'    =>  "2020-06-15 11:52:07"
            ],
        ];
        foreach($array as $pat)
        Patient::create($pat);
    }
}
