<?php

namespace App\Console\Commands;



use App\RappelSms;

use App\Rendezvous;
use Illuminate\Console\Command;
use Nexmo\Laravel\Facade\Nexmo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SendSms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rdv:send_sms_to_patient';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sms Sent Successfully';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $rdv=Rendezvous::whereNotIn('id', function($q){
          $q->select('RdvId')->from('rappel_sms');
          })
          ->whereRaw('TIMESTAMPDIFF(HOUR,CONCAT(Date," ",Heure), CURRENT_TIMESTAMP ) <= 24')
          ->get(); 
               //dd($rdv);
            if( !empty($rdv) ) {
              foreach( $rdv as $rdvs){
                  Nexmo::message()->send([
                      'to'   => $rdvs->patient->Tel,
                      'from' => 'Cabinet Médical',
                      'text' =>"Bonjour " .$rdvs->patient->Nom.
                        ", On vous rappelle que votre rendez vous aura lieu demain le " .$rdvs->Date. " à " .$rdvs->Heure                       
                  ]);
                Session::flash('success', 'sms sent');
                  RappelSms::create([
                    "RdvId" => $rdvs->id,
                  ]); 
              }
            }  
    }
}
