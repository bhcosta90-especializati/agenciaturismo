<?php

namespace App\Forms\Admin;

use App\Models\Plane;
use App\Services\Admin\BrandService;
use App\Services\Admin\PlaneService;
use Kris\LaravelFormBuilder\Form;

class PlaneForm extends Form
{
    public function __construct(private PlaneService $planeService, private BrandService $brandService)
    {
        
    }
    public function buildForm()
    {
        $id = $this->request->route('plane');

        $this->add('sku', 'text', [
            'label' => __('Identificação'),
            'rules' => [
                'required',
                'max:100',
                'min:3',
                "unique:planes,sku,{$id},id"
            ],
        ])->add('class', 'select', [
            'label' => __('Classe'),
            'empty_value' => 'Selecione...',
            'choices' => $classes = $this->planeService->class(),
            'rules' => [
                'in:' . implode(',', array_keys($classes))
            ]
        ])->add('brand_id', 'select', [
            'label' => __('Marca'),
            'empty_value' => 'Selecione...',
            'choices' => $this->brandService->pluck(),
            'rules' => [
                'exists:brands,id'
            ]
        ])->add('qtd_passengers', 'text', [
            'label' => __('Quantidade de passegeiros'),
            'rules' => [
                'numeric',
                'min:1',
                'max:1000',
            ]
        ]);
    }
}
