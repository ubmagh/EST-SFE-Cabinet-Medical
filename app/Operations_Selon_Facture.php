<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operations_Selon_Facture extends Model
{
    //
    public $timestamps = false;
    public $table="operations__selon__factures";
    protected $fillable = [
         'FactureId', 'OperationId',
    ];
}