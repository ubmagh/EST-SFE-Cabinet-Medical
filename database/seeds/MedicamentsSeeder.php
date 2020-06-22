<?php

use Illuminate\Database\Seeder;
use App\Medicament;

class MedicamentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //'Nom', 'Prise', 'Quand'
        $array=[
            [
                'Nom' => 'Aspirine',
                'Prise' => 'Comprimés',
                'Quand' => 'indifini',
            ],
            [
                'Nom' => 'Azathioprine',
                'Prise' => 'Comprimés',
                'Quand' => 'avant',
            ],[
                'Nom' => 'Éphédrine',
                'Prise' => 'injection',
                'Quand' => 'indifini',
            ],[
                'Nom' => 'Flucytosine',
                'Prise' => 'Capsules',
                'Quand' => 'indifini',
            ],[
                'Nom' => 'Amphotéricine',
                'Prise' => 'Sachets',
                'Quand' => 'avant',
            ],
            [
                'Nom' => 'Doxycycline',
                'Prise' => 'Capsules',
                'Quand' => 'indifini',
            ],
            [
                'Nom' => 'Ploxycyne',
                'Prise' => 'Comprimés',
                'Quand' => 'indifini',
            ],
            [
                'Nom' => 'Amiodarone',
                'Prise' => 'gélules',
                'Quand' => 'indifini',
            ],[
                'Nom' => 'Digoxine',
                'Prise' => 'Comprimés',
                'Quand' => 'indifini',
            ],[
                'Nom' => 'Mupirocine',
                'Prise' => 'gélules',
                'Quand' => 'indifini',
            ],[
                'Nom' => 'Diazépam',
                'Prise' => 'Comprimés',
                'Quand' => 'indifini',
            ],
            [
                'Nom' => 'DOLIPRANE',
                'Prise' => 'gélules',
                'Quand' => 'indifini',
            ],[
                'Nom' => 'SPASFON',
                'Prise' => 'Comprimés',
                'Quand' => 'indifini',
            ],[
                'Nom' => 'LAMALINE',
                'Prise' => 'suppositoire',
                'Quand' => 'indifini',
            ],
            [
                'Nom' => 'RTYUKa',
                'Prise' => 'suppositoire',
                'Quand' => 'indifini',
            ],
        ];

        foreach($array as $pat)
            Medicament::create($pat);
    }
}
