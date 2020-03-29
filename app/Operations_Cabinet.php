<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operations_Cabinet extends Model
{
    //
    public $timestamps = false;
    public $table="operations__cabinets";
    protected $fillable = [
        'Intitule', 'Prix', 'Description',
    ];
}