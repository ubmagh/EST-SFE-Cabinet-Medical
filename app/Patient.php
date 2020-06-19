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


    public function consultation()
    {
      return $this->hasMany('App\Consultation' , 'PatientId');
    }

    public function lettre()
    {
      return $this->hasMany('App\Lettre_au_confrere' , 'PatientId');
    }

    public function certificat()
    {
      return $this->hasMany('App\Certificat' , 'PatientId');
    }

    public function Check_Complet(){
      if( $this->Tel && $this->Email && $this->adresse && $this->Ville && $this->DateNaissance && $this->Occupation && $this->Nationnalite )
      return true;
      return false;
    }
    
}