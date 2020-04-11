<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rendezvous extends Model
{
    //
    public $timestamps = false;
    public $table="rendervouses";
    protected $fillable = [
        'Date', 'Heure', 'PatientId', 'Description', 'SecretaireId', 'Statut'
    ];
}