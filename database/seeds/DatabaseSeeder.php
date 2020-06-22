<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
       Eloquent::unguard();
       $this->call(secretaireSeeder::class);
       $this->call(medcinSeeder::class);
       $this->call(patientSeeder::class);
       $this->call(confrereSeeder::class);
       $this->call(MedicamentsSeeder::class);
       $this->call(operationsSeeder::class);
    }

    // $ composer dump-autoload |=> after any change

}