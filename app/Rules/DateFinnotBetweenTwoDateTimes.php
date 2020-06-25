<?php

namespace App\Rules;

use App\Rendezvous;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class DateFinnotBetweenTwoDateTimes implements Rule
{
    public  $dateTimeFin;
    public $rdvID;
    /**
     * Create a new rule instance.
     * @param  string  $dateTimeFin date de Fin de rdv
     * @param  int  $rdvID  en cas de modification d'un rdv
     * @return void
     */
    public function __construct( $dateTimeFin="",$rdvID=null)
    {
        //  

    $this->dateTimeFin = date( 'Y-m-d H:i',strtotime($dateTimeFin));
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
        //Verify that the given time is between 07:00 and 19:00
        
        $tmp = Carbon::createFromTimeString($this->dateTimeFin);
        $tmp = Carbon::createFromFormat('H:i', $tmp->format('H:i'));

        if( !$tmp->between(Carbon::createFromTime(07,30,00),Carbon::createFromTime(19,00,00)))
            return false;

        if($this->rdvID!=null)
            $last_dateTimes = Rendezvous::where('DateTimeDebut','<',$this->dateTimeFin)->where('DateTimeFin','>=',$this->dateTimeFin)->where('id','!=',$this->rdvID)->get();
        else
            $last_dateTimes = Rendezvous::where('DateTimeDebut','<',$this->dateTimeFin)->where('DateTimeFin','>=',$this->dateTimeFin)->get();

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