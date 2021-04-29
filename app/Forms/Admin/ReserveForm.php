<?php

namespace App\Forms\Admin;

use App\Rules\CheckAvailableFlight;
use App\Services\Admin\FlightService;
use App\Services\Admin\ReserveService;
use App\Services\Admin\UserService;
use Kris\LaravelFormBuilder\Form;

class ReserveForm extends Form
{
    public function __construct(
        private UserService $userService,
        private FlightService $flightService,
        private ReserveService $reserveService
    ) {
    }
    public function buildForm()
    {
        $disabled = false;
        if($this->getModel() && $this->getModel()?->id){
            $disabled = true;
        }

        $this->add('user_id', 'select', [
            'empty_value' => 'Selecione...',
            'choices' => $this->userService->pluck(),
            'attr' => ['disabled' => $disabled],
            'label' => "Usuário",
            'rules' => [
                'required',
                'exists:users,id' 
            ]
        ])->add('flight_id', 'select', [
            'empty_value' => 'Selecione...',
            'choices' => $this->flightService->pluck(),
            'attr' => ['disabled' => $disabled],
            'label' => "Voo",
            'rules' => [
                'required',
                'exists:flights,id',
                new CheckAvailableFlight()
            ]
        ])->add('date_reserved', 'date', [
            'label' => "Data da reserva",
            'value' => date('Y-m-d'),
            'attr' => ['disabled' => $disabled],
            'rules' => [
                'required',
                'date',
                'before:tomorrow'
            ]
        ])->add('status', 'select', [
            'empty_value' => 'Selecione...',
            'choices' => $this->reserveService->status(),
            'label' => "Status",
            "rules" => [
                "required",
                "in:" . implode(',', array_keys($this->reserveService->status())),
            ]
        ]);
    }
}
