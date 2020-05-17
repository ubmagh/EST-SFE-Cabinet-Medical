<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operations_Selon_Consultation extends Model
{
    //
    public $timestamps = false;
    public $table="operations__selon__Consultation";
    protected $fillable = [
         'ConsultationID', 'OperationId',
    ];
}