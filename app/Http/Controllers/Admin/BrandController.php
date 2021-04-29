<?php

namespace App\Http\Controllers\Admin;

use App\Forms\Admin\BrandForm as Form;
use App\Http\Controllers\Controller;
use App\Services\Admin\BrandService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Kris\LaravelFormBuilder\FormBuilder;

class BrandController extends Controller
{
    public function __construct(private BrandService $service)
    {
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->service->index();
        $title = 'Marcas de avião';
        
        return view('admin.brand.index', compact('data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(Form::class, [
            'method' => 'POST',
            'url' => route('admin.brand.store')
        ])->add('btn', 'submit', [
            "attr" => ['class' => 'btn btn-primary'],
            'label' => __('Cadastrar')
        ]);
        $title = 'Cadastrar marca de avião';

        return view('admin.brand.create', compact('form', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(Form::class, [
            'method' => 'POST',
            'url' => route('admin.brand.store')
        ]);

        $form->redirectIfNotValid();

        $values = $form->getFieldValues();
        try {
            $this->service->store($values);
            return redirect()->route('admin.brand.index')->with('success', __('Cadastro realizado com sucesso'));
        } catch (Exception $e) {
            if ($e->getCode() == Response::HTTP_BAD_REQUEST) {
                return redirect()->back()->withInput($values)->with('error', $e->getMessage());
            }
            throw $e;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(Form::class, [
            'method' => 'PUT',
            'url' => route('admin.brand.update', $id),
            'model' => $this->service->get($id)
        ])->add('btn', 'submit', [
            "attr" => ['class' => 'btn btn-primary'],
            'label' => __('Editar')
        ]);
        $title = 'Editar marca de avião';

        return view('admin.brand.edit', compact('form', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(Form::class, [
            'method' => 'PUT',
            'url' => route('admin.brand.update', $id),
        ]);

        $form->redirectIfNotValid();

        $values = $form->getFieldValues();
        try {
            $this->service->update($id, $values);
            return redirect()->route('admin.brand.index')->with('success', __('Atualizado com sucesso'));
        } catch (Exception $e) {
            if ($e->getCode() == Response::HTTP_BAD_REQUEST) {
                return redirect()->back()->withInput($values)->with('error', $e->getMessage());
            }
            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->service->delete($id);
            return redirect()->route('admin.brand.index')->with('success', __('Marca deletada com sucesso'));
        } catch (Exception $e) {
            if ($e->getCode() == Response::HTTP_BAD_REQUEST) {
                return redirect()->back()->with('error', $e->getMessage());
            }
            throw $e;
        }
    }
}
