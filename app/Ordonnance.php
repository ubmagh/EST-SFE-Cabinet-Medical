<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ordonnance extends Model
{
    //
    public $timestamps = false;
    public $table="ordonnances";
    protected $fillable = [
        'Date', 'ConsultationId','Quand', 'Remarques','Periode', 'NbrParJour',  'Allergies', 'Antecedants',
    ];
}