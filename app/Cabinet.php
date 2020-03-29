<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cabinet extends Model
{
    //
    public $timestamps = false;
    public $table="cabinets";
    protected $fillable = [
        'Nom', 'Adresse', 'logo', 'Specialites', 'Description', 'Tel', 'Email', 'Fax', 'AdminPseudo', 'AdminPwD', 'AdminEmail', 'AdminToken', 'AdminLastLogin',
    ];
}