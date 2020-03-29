<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    //
    public $timestamps = false;
    public $table="factures";
    protected $fillable = [
        'ConsultationId', 'Date', 'Somme', 'Paye', 'Remise',
    ];
}