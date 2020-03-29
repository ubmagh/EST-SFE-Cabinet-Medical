<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    //
    public $timestamps = false;
    public $table="couriers";
    protected $fillable = [
        'Nom', 'Objet', 'Message', 'Email', 'Date', 'Fichiers',
    ];
}