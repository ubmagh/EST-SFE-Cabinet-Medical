<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fichier extends Model
{
    //
    public $timestamps = false;
    public $table="fichiers";
    protected $fillable = [
        'Date', 'Type', 'CurrentName', 'OriginalName', 'Size', 'ConsultationId',
    ];

    public function Consultation(){
        return $this->BelongsTo('App\Consultation' , 'ConsultationId');
    }

}