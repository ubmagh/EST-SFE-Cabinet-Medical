<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    //
    public $timestamps = false;
    public $table="patients";
    protected $fillable = [
        'email', 'password', 'UserType', 'LastLogin',  'CreatedAt', 'Activated',
    ];
}