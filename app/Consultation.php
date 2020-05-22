<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    //
    public $timestamps = false;
    public $table="consultations";
    protected $fillable = [
        'Date', 'Type', 'Description', 'PatientId', 'MedcinId', 'Urgent', 'ExamensAfaire', 
    ];

    public function medecin() 
    {
        return $this->BelongsTo('App\Medcin' , 'MedcinId');
    }

     public function patient(){
        return $this->BelongsTo('App\Patient' , 'PatientId');
     }
}