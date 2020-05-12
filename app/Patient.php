<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    //
    public $timestamps = false;
    public $table="patients";
    protected $fillable = [
        'id_civile', 'Nom', 'Prenom',  'Tel', 'Email', 'Sexe' , 'adresse' 
        , 'Ville' , 'DateNaissance' , 'Occupation' , 'Nationnalite'
        , 'typeMutuel' ,  'ref_mutuel' 
    ];

    public function patient()
    {
      return $this->hasMany('App\Rendezvous' , 'PatientId');
    }

    public function salleAttente()
    {
      return $this->hasMany('App\salleAttente' , 'PatientId');
    }
}