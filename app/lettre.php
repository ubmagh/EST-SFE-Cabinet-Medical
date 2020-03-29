<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lettre extends Model
{
    //
    public $timestamps = false;
    public $table="lettres";
    protected $fillable = [
        'Recepteur', 'Destinataire', 'Date', 'Message', 'Consultation', 'Vue', 'Fichiers',
    ];
}