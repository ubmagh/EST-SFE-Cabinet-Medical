<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    //
    public $timestamps = false;
    public $table="consultations";
    protected $fillable = [
        'Type', 'Description', 'PatientId', 'MedcinId', 'SecretaireId', 'Urgent', 'ExamensAfaire', 
    ];
}