<?php

namespace App\Rules;

use App\Rendezvous;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class DateDebutnotBetweenTwoDateTimes implements Rule
{
    public string $dateTimeDebut;
    public $rdvID;
    /**
     * Create a new rule instance.
     * @param  string  $dateTimeDebut date de debut de rdv
     * @param  int  $rdvID  en cas de modification d'un rdv
     * @return void
     */
    public function __construct(string $dateTimeDebut,$rdvID=null)
    {
        //  

    $this->dateTimeDebut = date( 'Y-m-d H:i',strtotime($dateTimeDebut));
    $this->rdvID = $rdvID;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
        //Verify that the given time is between 07:00 and 19:00
        $tmp = Carbon::createFromTimeString($this->dateTimeDebut);
        $tmp = Carbon::createFromFormat('H:i', $tmp->format('H:i'));
        
        if( !$tmp->between(Carbon::createFromTime(07,00,00),Carbon::createFromTime(18,30,00)))
            return false;

        if($this->rdvID!=null)
            $last_dateTimes = Rendezvous::where('DateTimeDebut','<=',$this->dateTimeDebut)->where('DateTimeFin','>',$this->dateTimeDebut)->where('id','!=',$this->rdvID)->get();
        else
            $last_dateTimes = Rendezvous::where('DateTimeDebut','<=',$this->dateTimeDebut)->where('DateTimeFin','>',$this->dateTimeDebut)->get();
        
        if(count($last_dateTimes))
            return false;
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ' la Date selectionné est indisponible voir le calendrier ';
    }
}