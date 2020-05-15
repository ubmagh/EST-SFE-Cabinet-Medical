<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class notBetweenTwoDateTimes implements Rule
{
    public string $dateTimeDebut;
    public string $dateTimeFin;
    public string $myDateTime;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(string $dateTimeDebut, string $dateTimeFin, string $myDateTime)
    {
        //  

    $this->myDateTime = $myDateTime;
    $this->dateTimeDebut = $dateTimeDebut;
    $this->dateTimeFin = $dateTimeFin;
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
        $debut = Carbon::parse($this->dateTimeDebut);
        $fin = Carbon::parse($this->dateTimeFin);
        $myDateTimy = Carbon::parse($this->myDateTime);
        // return false if $myDateTimy is between the others
        
        if($myDateTimy->equalTo($fin))// but it can equals the second dateTime
            return true;
        if( $myDateTimy->between($debut,$fin) )
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