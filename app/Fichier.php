<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


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

    public function Delete_Physically(){
        switch($this->Type){
            case 'image':
                Storage::disk('ConsultationImages')->delete( $this->CurrentName );
            break;
            case 'video':
                Storage::disk('ConsultationVideos')->delete( $this->CurrentName );
            break;
            case 'pdf':
                Storage::disk('ConsultationPDFs')->delete( $this->CurrentName );
            break;
            case 'zip':
                Storage::disk('ConsultationZips')->delete( $this->CurrentName );
            break;
        }
        $this->delete();
    }

}