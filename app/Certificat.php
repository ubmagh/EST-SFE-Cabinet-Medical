<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificat extends Model
{
   
    public $timestamps = false;
    public $table="certificats";
    protected $fillable = [
        'date','PatientId', 'Motif',  'Duree', 'medcinId',
    ];

    public function patient(){
        return $this->BelongsTo('App\Patient' , 'PatientId');
     }
     
}