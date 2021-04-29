<?php

namespace App\Forms\Admin;

use Kris\LaravelFormBuilder\Form;

class BrandForm extends Form
{
    public function buildForm()
    {
        $id = $this->request->route('brand');
        $this->add('name', 'text', [
            'label' => __('Nome'),
            'rules' => [
                'required',
                'max:100',
                'min:3',
                "unique:brands,name,{$id},id"
            ]
        ]);
    }
}
