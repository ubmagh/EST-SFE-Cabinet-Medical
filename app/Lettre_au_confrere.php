<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lettre_au_confrere extends Model
{
    //
    public $timestamps = false;
    public $table="lettre_au_confreres";
    protected $fillable = [
        'ConfrereID', 'Titre', 'Message', 'date', 'MedcinId', 'PatientId',
    ];
    

    public function confrere(){
        return $this->BelongsTo('App\confrere' , 'ConfrereID');
     }
}