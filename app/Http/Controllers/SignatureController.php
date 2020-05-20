<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SignatureController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:medcin');
    } 

    public function getImage(Request $request, $filename){

        if (!Storage::disk('Signatures')->exists($filename)) {
            abort(404);
        }

        $local_path = config('filesystems.disks.Signatures.root') . DIRECTORY_SEPARATOR . $filename;

        return response()->file($local_path);

    }

}