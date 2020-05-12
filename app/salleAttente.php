<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class salleAttente extends Model
{
    //
    public $timestamps = false;
    public $table="salle_attentes";
    protected $fillable = [
        'PatientId', 'dateArrive', 'passe', 'Urgent'
    ];
    public function patient(){
        return $this->BelongsTo('App\Patient' , 'PatientId');
     }
}