<?php

namespace App\Forms\Admin;

use App\Services\Admin\AirportService;
use App\Services\Admin\PlaneService;
use App\Services\Admin\StateService;
use Kris\LaravelFormBuilder\Form;

class FlightForm extends Form
{
    public function __construct(
        private AirportService $airportService,
        private PlaneService $planeService
    ) {
    }
    
    public function buildForm()
    {
        $this->add('plane_id', 'select', [
            'label' => __('Escolha o avião'),
            'empty_value' => 'Selecione...',
            'choices' => $this->planeService->pluck(),
            'rules' => [
                'required',
                'exists:planes,id',
            ]
        ])->add('airport_origin_id', 'select', [
            'label' => __('Aeroporto de origem'),
            'empty_value' => 'Selecione...',
            'choices' => $airports = $this->airportService->pluck(),
            'rules' => [
                'required',
                'different:airport_destination_id',
                'exists:airports,id',
            ]
        ])->add('airport_destination_id', 'select', [
            'label' => __('Aeroporto de destino'),
            'empty_value' => 'Selecione...',
            'choices' => $airports,
            'rules' => [
                'required',
                'exists:airports,id'
            ],
        ])->add('date', 'date', [
            'label' => __('Data'),
            'format' => 'Y-m-d',
            'rules' => [
                'required',
                'date',
                'after:today'
            ],
        ])->add('time_duration', 'time', [
            'label' => __('Duração'),
            'rules' => [
                'required',
            ],
        ])->add('hour_output', 'time', [
            'label' => __('Hora da saída'),
            'rules' => [
                'required',
            ],
        ])->add('arrival_time', 'time', [
            'label' => __('Hora de chegada'),
            'rules' => [
                'required',
            ],
        ])->add('old_price', 'number', [
            'label' => __('Preço anterior'),
            'attrs' => ['step' => '0.01'],
            'rules' => [
                'nullable',
            ],
        ])->add('price', 'number', [
            'label' => __('Preço atual'),
            'attrs' => ['step' => '0.01'],
            'rules' => [
                'required',
            ],
        ])->add('total_plots', 'number', [
            'label' => __('Total máximo de parcelas'),
            'rules' => [
                'required',
                'numeric',
                'min:0',
            ],
        ])->add('is_promotion', 'checkbox', [
            'label' => __('Preço promocional?'),
        ])->add('qtd_stops', 'number', [
            'label' => __('Quantidade de paradas'),
            'rules' => [
                'required',
                'numeric',
                'min:0',
            ],
        ])->add('description', 'textarea', [
            'label' => __('Descrição'),
            'rules' => [
                'nullable',
            ],
        ]);
    }
}
