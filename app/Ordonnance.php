<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ordonnance extends Model
{
    //
    public $timestamps = false;
    public $table="ordonnances";
    protected $fillable = [
        'ConsultationId', 'Description',
    ];
}