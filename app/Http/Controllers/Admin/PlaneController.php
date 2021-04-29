<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\PlaneService;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Forms\Admin\PlaneForm as Form;
use App\Models\Plane;
use App\Services\Admin\BrandService;
use Exception;
use Illuminate\Http\Response;

class PlaneController extends Controller
{
    public function __construct(
        private PlaneService $service,
        private BrandService $brandService,
        private Plane $plane
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->service->index();
        $title = 'Avião';
        $brands = $this->brandService->pluck();
        $classess = $this->plane->class();
        
        return view('admin.plane.index', compact('data', 'title', 'brands', 'classess'));
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
            'url' => route('admin.plane.store'),
        ])->add('btn', 'submit', [
            "attr" => ['class' => 'btn btn-primary'],
            'label' => __('Cadastrar')
        ]);
        $title = 'Cadastrar marca de avião';

        return view('admin.plane.create', compact('form', 'title'));
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
            'url' => route('admin.plane.store')
        ]);

        $form->redirectIfNotValid();

        $values = $form->getFieldValues();
        try {
            $this->service->store($values);
            return redirect()->route('admin.plane.index')->with('success', __('Cadastro realizado com sucesso'));
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
            'url' => route('admin.plane.update', $id),
            'model' => $this->service->get($id),
        ])->add('btn', 'submit', [
            "attr" => ['class' => 'btn btn-primary'],
            'label' => __('Editar')
        ]);
        $title = 'Editar marca de avião';

        return view('admin.plane.edit', compact('form', 'title'));
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
            'url' => route('admin.plane.update', $id),
            'model' => $this->service->get($id)
        ]);

        $form->redirectIfNotValid();

        $values = $form->getFieldValues();
        try {
            $this->service->update($id, $values);
            return redirect()->route('admin.plane.index')->with('success', __('Atualizado com sucesso'));
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
            return redirect()->route('admin.plane.index')->with('success', __('Marca deletada com sucesso'));
        } catch (Exception $e) {
            if ($e->getCode() == Response::HTTP_BAD_REQUEST) {
                return redirect()->back()->with('error', $e->getMessage());
            }
            throw $e;
        }
    }
}
