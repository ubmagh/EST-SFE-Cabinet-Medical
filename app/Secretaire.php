<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Secretaire extends Model
{
    //
    public $timestamps = false;
    public $table="secretaires";
    protected $fillable = [
        'Nom', 'Prenom', 'Adresse', 'Tel', 'Email', 'Pseudo', 'PwD', 'Token', 'DernierLog', 'created_at'
    ];
}