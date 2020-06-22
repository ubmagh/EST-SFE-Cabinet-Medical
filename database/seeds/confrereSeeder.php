<?php

use Illuminate\Database\Seeder;
use App\confrere;

class confrereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
        [
            'Nom' => 'Malena Dorrell',
            'Tel' => '0634476170',
            'Fax' => '0532372536',
            'Email' => 'mdorrell0@comcast.net',
            'adresse' => 'Bureau 10, Agadir Plaza',
            'Ville' => 'Agadir',
            'Specialite' => "Opticien",
            'date_ajout' => '2017-01-28',
        ],
        [
            'Nom' => 'Clare Greave',
            'Tel' => '0688184819',
            'Fax' => '0521810652',
            'Email' => 'cgreave1@mapy.cz',
            'adresse' => '267 Randy Parkway',
            'Ville' => 'Marrakech',
            'Specialite' => "   -   ",
            'date_ajout' => '2018-07-23',
        ],
        [
            'Nom' => 'Coraline Cossem',
            'Tel' => '0639556828',
            'Fax' => '0596660582',
            'Email' => 'ccossem2@spotify.com',
            'adresse' => '64278 Fair Oaks Terrace',
            'Ville' => 'Dawang',
            'Specialite' => "La neurologie",
            'date_ajout' => '2018-03-14',
        ],
        [
            'Nom' => 'Siobhan Pfeiffer',
            'Tel' => '0669987755',
            'Fax' => '0556093397',
            'Email' => 'spfeiffer3@over-blog.com',
            'adresse' => '1493 Shasta Pass',
            'Ville' => 'Silago',
            'Specialite' => "L’odontologie",
            'date_ajout' => '2019-12-27',
        ],
        [
            'Nom' => 'Brandyn Housbie',
            'Tel' => '0645313950',
            'Fax' => '0511099908',
            'Email' => 'bhousbie4@ucoz.com',
            'adresse' => '91 Garrison Plaza',
            'Ville' => 'Dundrum',
            'Specialite' => "La radiologie",
            'date_ajout' => '2019-10-10',
        ],
        [
            'Nom' => 'Nevins Grimm',
            'Tel' => '0682315221',
            'Fax' => '0577445544',
            'Email' => 'ngrimm5@reddit.com',
            'adresse' => '4772 Pleasure Avenue',
            'Ville' => 'Waikambila',
            'Specialite' => "La rhumatologie",
            'date_ajout' => '2020-05-10',
        ],
        [
            'Nom' => 'Claire Hulks',
            'Tel' => '0660808181',
            'Fax' => '0520278093',
            'Email' => 'chulks6@shinystat.com',
            'adresse' => '99 Ridge Oak Way',
            'Ville' => 'Il’ichëvo',
            'Specialite' => "La gériatrie",
            'date_ajout' => '2017-04-30',
        ],
        [
            'Nom' => 'Rad Mein',
            'Tel' => '0668750129',
            'Fax' => '0529330973',
            'Email' => 'rmein7@ca.gov',
            'adresse' => '1 Mosinee Junction',
            'Ville' => 'Pereleshino',
            'Specialite' => "   -   ",
            'date_ajout' => '2017-05-19',
        ],
        [
            'Nom' => 'Lauralee Tomala',
            'Tel' => '0663068632',
            'Fax' => '0548056771',
            'Email' => 'ltomala8@devhub.com',
            'adresse' => '8951 Havey Point',
            'Ville' => 'Nirji',
            'Specialite' => "L’hépatologie",
            'date_ajout' => '2019-04-28',
        ],
        [
            'Nom' => 'Junina Frean',
            'Tel' => '0628541095',
            'Fax' => '0581851639',
            'Email' => 'jfrean9@vistaprint.com',
            'adresse' => '951 Grayhawk Crossing',
            'Ville' => 'Lom Sak',
            'Specialite' => "La médecine générale",
            'date_ajout' => '2019-01-24',
        ],
        [
            'Nom' => 'Devondra Shaul',
            'Tel' => '0652256232',
            'Fax' => '0512671179',
            'Email' => 'dshaula@yahoo.co.jp',
            'adresse' => '036 Westend Street',
            'Ville' => 'Savannah',
            'Specialite' => "La médecine préventive",
            'date_ajout' => '2017-12-19',
        ],
        [
            'Nom' => 'Ardith Thurber',
            'Tel' => '0661401316',
            'Fax' => '0522086660',
            'Email' => 'athurberb@wp.com',
            'adresse' => '5637 3rd Park',
            'Ville' => 'Siqian',
            'Specialite' => "La médecine générale",
            'date_ajout' => '2018-04-09',
        ],
        [
            'Nom' => 'Kalil Edwicker',
            'Tel' => '0662635673',
            'Fax' => '0573420513',
            'Email' => 'kedwickerc@google.co.uk',
            'adresse' => '7 Roxbury Pass',
            'Ville' => 'Lycksele',
            'Specialite' => "La psychiatrie",
            'date_ajout' => '2015-10-31',
        ],
        [
            'Nom' => 'Carline Clarricoates',
            'Tel' => '0648706975',
            'Fax' => '0563494711',
            'Email' => 'cclarricoatesd@cdbaby.com',
            'adresse' => '0922 Melody Court',
            'Ville' => 'Santa Cruz do Bispo',
            'Specialite' => "La cardiologie",
            'date_ajout' => '2017-02-10',
        ],
        ];
        foreach($array as $pat)
        confrere::create($pat);
    }
}
