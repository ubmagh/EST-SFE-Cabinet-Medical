<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Medcin extends Authenticatable
{
    use Notifiable;

    //

    protected $guard = 'medcin';


    public $timestamps = false;
    public $table="medcins";
    protected $fillable = [
        'Nom', 'Prenom', 'Specialite', 'Signature', 'Adresse', 'Tel', 'Email', 'Pseudo', 'password', 'remember_token', 'DernierLog', 'PrixDeConsultation', 'created_at'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function consultation()
    {
      return $this->hasMany('App\Consultation' , 'MedcinId');
    }
}