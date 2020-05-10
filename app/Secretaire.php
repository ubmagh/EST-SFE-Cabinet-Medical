<?php

namespace App;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;

class Secretaire extends Authenticatable implements CanResetPassword
{
    use Notifiable;
    //

    protected $guard = 'secretaire';

    public $timestamps = false;
    public $table="secretaires";
    protected $fillable = [
        'Nom', 'Prenom', 'Adresse', 'Tel', 'Email', 'Pseudo', 'password', 'DernierLog', 'created_at'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function secretaire()
    {
      return $this->hasMany('App\Rendezvous' , 'SecretaireId');
    }

}