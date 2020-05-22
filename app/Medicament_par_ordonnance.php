<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicament_par_ordonnance extends Model
{
    //
    public $timestamps = false;
    public $table="medicament_par_ordonnances";
    protected $fillable = [
        'MedicamentId', 'OrdonnanceId', 'Periode', 'NbrParJour',
    ];

    public function medicament(){
        return $this->BelongsTo('App\Medicament' , 'MedicamentId');
     }

}