<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicament extends Model
{
    //
    public $timestamps = false;
    public $table="medicaments";
    protected $fillable = [
        'Nom', 'Prise', 'Quand'
    ];

    public function medicament()
    {
      return $this->hasMany('App\Medicament_par_ordonnance' , 'MedicamentId');
    }

    
}