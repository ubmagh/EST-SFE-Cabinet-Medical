<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RappelSms extends Model
{
    //
    public $timestamps = false;
    public $table="rappel_sms";
    protected $fillable = [
        'DateEnvoi', 'RdvId',
    ];
}