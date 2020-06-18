<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operations_Selon_Consultation extends Model
{
    //
    public $timestamps = false;
    public $table="operations__selon__Consultation";
    protected $fillable = [
        'ConsultationID', 'OperationId', 'Remarque',
    ];

    public function Operation(){
        return $this->BelongsTo('App\Operations_Cabinet' , 'OperationId');
    }

    public function consultation()
    {
        return $this->belongsTo('App\consultations','ConsultationID');
    }


    public function consultation_selon_operation(){
        return $this->BelongsTo('App\Consultation' , 'ConsultationID');
    }



}