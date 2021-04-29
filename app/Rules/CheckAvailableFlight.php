<?php

namespace App\Rules;

use App\Services\Admin\FlightService;
use Illuminate\Contracts\Validation\Rule;

class CheckAvailableFlight implements Rule
{
    private FlightService $flightService;
    
    public function __construct()
    {
        $this->flightService = app(FlightService::class);
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
        return $this->getReserverAvaliable($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('A quantidade de reservas superou a quantidade de passageiros permitidos');
    }

    private function getReserverAvaliable($id)
    {
        return $this->flightService->getReserverAvaliable($id);
    }
}
