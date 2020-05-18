<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class salleAttente extends Model
{
    //
    public $timestamps = false;
    public $table="salle_attentes";
    protected $fillable = [
         'id','DateArrive', 'PatientId', 'ConsultationID', 'rdvID', 'SecretaireID', 'Urgent', 'Quitte', 'startTime',
    ];
    
    public function patient(){
        return $this->BelongsTo('App\Patient' , 'PatientId');
     }

     

}