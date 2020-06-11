<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    //
    public $timestamps = false;
    public $table="examens";
    protected $fillable = [
        'Titre', 'Valeur', 'ConsultationId',
    ];

    public function consultation()
    {
        return $this->belongsTo('App\consultations','ConsultationId');
    }
}