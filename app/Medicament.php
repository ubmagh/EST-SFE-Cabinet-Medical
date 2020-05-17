<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicament extends Model
{
    //
    public $timestamps = false;
    public $table="medicaments";
    protected $fillable = [
        'Nom', 'Prise', 'Quand'
    ];
}