<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paiment extends Model
{
    //
    public $timestamps = false;
    public $table="paiments";
    protected $fillable = [
        'Motif', 'Montant', 'date', 'FactureId',
    ];


    public function Facture(){
        return $this->BelongsTo('App\Facture' , 'FactureId');
    }

    public function Is_recette(){
        if($this->FactureId)
            return true;
        return false;
    }


}