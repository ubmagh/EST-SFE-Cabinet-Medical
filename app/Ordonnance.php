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

    public function consultation()
     {
     return $this->belongsTo('App\Consultation', 'ConsultationID');
     }
     
     public function MedicamentFromThisOrd()
     {
         return $this->hasMany('App\Medicament_par_ordonnance','OrdonnanceId');
     }

}