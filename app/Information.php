<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    //
    public $timestamps = false;
    public $table="information";
    protected $fillable = [
        'PatientId', 'Categorie', 'Intitule', 'description'
    ];
}