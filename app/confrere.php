<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class confrere extends Model
{
    //
    public $timestamps = false;
    public $table="confreres";
    protected $fillable = [
            "Nom","Prenom","Tel",'Fax',"Email","adresse","Ville","Specialite",
    ];
}