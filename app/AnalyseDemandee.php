<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnalyseDemandee extends Model
{
    //
    public $timestamps = false;
    public $table="analyse_demandees";
    protected $fillable = [
        'ConsultationId', 'DemandeLe', 'Titre', 'ARendreLe', 'Description', 'RenduLe',
    ];
}