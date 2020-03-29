<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medcin extends Model
{
    //
    public $timestamps = false;
    public $table="medcins";
    protected $fillable = [
        'Nom', 'Prenom', 'Specialite', 'Signature', 'Adresse', 'Tel', 'Email', 'Pseudo', 'PwD', 'Token', 'DernierLog', 'created_at'
    ];
}