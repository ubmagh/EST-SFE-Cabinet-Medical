<?php

namespace App\Http\Controllers;

use App\Fichier;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use DB;

class FichierController extends Controller
{
    //

    public function GetImage($id){

        $image = Fichier::findOrFail($id);
        $path = storage_path('ConsultationFiles/Images/').'/'.$image->CurrentName;
        if (!File::exists( $path ) ||  $image->Type!='image' ) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }


    public function GetVideo($id){

        $video = Fichier::findOrFail($id);
        $path = storage_path('ConsultationFiles/Videos/').'/'.$video->CurrentName;
        if (!File::exists( $path ) ||  $video->Type!='video' ) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }


    public function GetPDF($id){

        $pdf = Fichier::findOrFail($id);
        $path = storage_path('ConsultationFiles/PDFs/').'/'.$pdf->CurrentName;
        if (!File::exists( $path ) ||  $pdf->Type!='pdf' ) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function GetZIP($id){

        $pdf = Fichier::findOrFail($id);
        $path = storage_path('ConsultationFiles/Zips/').'/'.$pdf->CurrentName;
        if (!File::exists( $path ) ||  $pdf->Type!='zip' ) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function GetSizes_ForStats(){

        $obj = (object) [];
        $obj->pdf = Fichier::select(DB::raw("SUM(Size) as sum"))->where('Type','pdf')->get()->sum;
        $obj->zip = Fichier::select(DB::raw("SUM(Size) as sum"))->where('Type','zip')->get()->sum;
        $obj->image = Fichier::select(DB::raw("SUM(Size) as sum"))->where('Type','image')->get()->sum;
        $obj->video = Fichier::select(DB::raw("SUM(Size) as sum"))->where('Type','video')->get()->sum;

        $obj->FreeSpace = disk_free_space( config('app.diskName') ); /// Windows Only 

        return $obj;
    }

}
