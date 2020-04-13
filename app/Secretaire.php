<?php

namespace App;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Secretaire extends Authenticatable
{
    use Notifiable;
    //

    protected $guard = 'secretaire';

    public $timestamps = false;
    public $table="secretaires";
    protected $fillable = [
        'Nom', 'Prenom', 'Adresse', 'Tel', 'Email', 'Pseudo', 'password', 'Token', 'DernierLog', 'created_at'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
}