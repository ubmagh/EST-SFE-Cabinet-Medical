<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificat extends Model
{
    //
    public $timestamps = false;
    public $table="certificats";
    protected $fillable = [
        'ConsultationId', 'Motif', 'Type', 'Duree',
    ];
}