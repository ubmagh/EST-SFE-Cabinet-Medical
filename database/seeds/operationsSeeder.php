<?php

use Illuminate\Database\Seeder;
use App\Operations_Cabinet;

class operationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $array=[
            [
                'Intitule'  =>  "L’extraction des dents",
                'Prix'  =>  "100",
                'Description'   =>  "L’extraction des dents"
            ],[
                'Intitule'  =>  "L’implantologie",
                'Prix'  =>  "150",
                'Description'   =>  "Cet acte chirurgical consiste à remplacer les dents manquantes par des implants en titane. Trois étapes sont à suivre pour cette opération"
            ],[
                'Intitule'  =>  "La freinectomie",
                'Prix'  =>  "170",
                'Description'   =>  "La freinectomie consiste en l’ablation d’un frein labial ou lingual si celui pose problème.	"
            ],[
                'Intitule'  =>  "La greffe gingivale",
                'Prix'  =>  "200",
                'Description'   =>  " Cette diminution de la gencive conduit au dévoilement des racines des dents, ce qui est peu esthétique et conduit à des risques élevés de caries."
            ],[
                'Intitule'  =>  "La greffe osseuse",
                'Prix'  =>  "240",
                'Description'   =>  "Il peut arriver que cet os alvéolaire se résorbe à cause de la perte des dents ou pour des raisons liées à la condition bucco-dentaire du patient.	"
            ],

        ];
        foreach($array as $pat)
        Operations_Cabinet::create($pat);

    }
}
