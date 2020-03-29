<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    //
    public $timestamps = false;
    public $table="examens";
    protected $fillable = [
        'Titre', 'Description', 'Fichiers', 'ConsultationId',
    ];
}