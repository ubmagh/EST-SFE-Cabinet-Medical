<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    //
    public $timestamps = false;
    public $table="factures";
    protected $fillable = [
        'ConsultationId','Motif', 'Date', 'Somme', 'Paye', 'Remise',
    ];


    public function consultation(){
        return $this->BelongsTo('App\Consultation' , 'ConsultationId');
     }
    
     
}