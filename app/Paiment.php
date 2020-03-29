<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paiment extends Model
{
    //
    public $timestamps = false;
    public $table="paiments";
    protected $fillable = [
        'Motif', 'Montant', 'date', 'FactureId', 'Type',
    ];
}