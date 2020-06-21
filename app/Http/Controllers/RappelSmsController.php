<?php

namespace App\Http\Controllers;
use App\RappelSms;
use DB;
use Illuminate\Http\Request;

class RappelSmsController extends Controller
{
    //

    public function GetStats(){
        $obj = (object) [];
        $obj->nbr = RappelSms::select( DB::raw('count(*) as num') )->first()->num;
        $obj->lastDate = RappelSms::orderby('DateEnvoi','DESC')->first();
        return $obj;
    }

}
