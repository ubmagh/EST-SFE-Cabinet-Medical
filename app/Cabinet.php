<?php

namespace App;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Cabinet extends Authenticatable
{
    //

    protected $guard = 'admin';



    public $timestamps = false;
    public $table="cabinets";
    protected $fillable = [
        'Nom', 'Adresse', 'logo', 'Specialites', 'Description', 'Tel', 'Email', 'Fax', 'AdminPseudo', 'password', 'AdminEmail', 'AdminToken', 'AdminLastLogin','remember_token',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}

}