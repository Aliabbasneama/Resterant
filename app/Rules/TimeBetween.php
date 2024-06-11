<?php

namespace App\Rules;


use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Carbon;

class TimeBetween implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $pickupDate = Carbon::parse($value);
        $pickupTime = Carbon::createFromTime($pickupDate->hour, $pickupDate->minute, $pickupDate->second);

        //when the resturent is open
        $earListTime = Carbon::createFromTimeString('9:00:00');
        //when the resturent close 
        $ListTime = Carbon::createFromTimeString('23:00:00');   

        return $pickupTime->between($earListTime,$ListTime) ? true : false;
       
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Please choose the Time between 17:00-23:00.';
    }
}
