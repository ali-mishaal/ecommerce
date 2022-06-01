<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Modules\CommonModule\Entities\CompanyVehicle;

class CheckKmNuber implements Rule
{
    protected $km_number;
    protected $vehicle_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($vehicle_id)
    {
        $this->vehicle_id = $vehicle_id;
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
        $oldKmNumber = $this->getOldKmNumber($this->vehicle_id);
        if ($value < $oldKmNumber){
            return false;
        }
        return true;
    }

    private function getOldKmNumber($vehicle_id)
    {
        $vehicle = CompanyVehicle::find($vehicle_id);
        return $vehicle->km_number;
    }
    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'please insert real km number greater than or equal to the old one';
    }
}
