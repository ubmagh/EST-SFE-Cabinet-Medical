<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rendezvous extends Model
{
    //
    public $timestamps = false;
    public $table="rendezvouses";
    protected $fillable = [
        'DateTimeDebut', 'DateTimeFin', 'PatientId', 'Description', 'SecretaireId', 'Statut'
    ];

    public function sectetaire() 
    {
        return $this->BelongsTo('App\Secretaire' , 'SecretaireId');
    }

     public function patient(){
        return $this->BelongsTo('App\Patient' , 'PatientId');
     }
}