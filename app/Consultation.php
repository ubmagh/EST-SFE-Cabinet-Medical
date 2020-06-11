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

    public function medcin(){
        return $this->BelongsTo('App\Medcin' , 'MedcinId');
    }

    public function patient(){
        return $this->BelongsTo('App\Patient' , 'PatientId');
    }

    public function salleAttente()
    {
        return $this->hasOne('App\salleAttente','ConsultationID');
    }

    public function Examen()
    {
        return $this->hasMany('App\Examen','ConsultationId');
    }

    public function OperationSelonConsu()
    {
        return $this->hasMany('App\Operations_Selon_Consultation','ConsultationID');
    }

    public function Ordonnance()
    {
        return $this->hasOne('App\Ordonnance','ConsultationId');
    }

}