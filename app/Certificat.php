<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificat extends Model
{
    /*
    public $timestamps = false;
    public $table="certificats";
    protected $fillable = [
        'ConsultationId', 'Motif', 'Type', 'Duree',
    ];*/
    //
    public $timestamps = false;
    public $table="certificats";
    protected $fillable = [
        'PatientId', 'Motif',  'Duree'
    ];

    public function patient(){
        return $this->BelongsTo('App\Patient' , 'PatientId');
     }
     
}