<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\ReserveService;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Forms\Admin\ReserveForm as Form;
use Exception;
use Illuminate\Http\Response;

class ReserveController extends Controller
{
    public function __construct(private ReserveService $service)
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
        $title = 'Reservas de passagens';
        $status = $this->service->status();
        
        return view('admin.reserve.index', compact('data', 'title', 'status'));
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
            'url' => route('admin.reserve.store')
        ])->add('btn', 'submit', [
            "attr" => ['class' => 'btn btn-primary'],
            'label' => __('Cadastrar')
        ]);
        $title = 'Cadastrar reserva';

        return view('admin.reserve.create', compact('form', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(Form::class);

        $form->redirectIfNotValid();

        $values = $form->getFieldValues();
        try {
            $this->service->store($values);
            return redirect()->route('admin.reserve.index')->with('success', __('Reservado com sucesso'));
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
            'url' => route('admin.reserve.update', $id),
            'model' => $this->service->get($id)
        ])->add('btn', 'submit', [
            "attr" => ['class' => 'btn btn-primary'],
            'label' => __('Editar')
        ]);
        $title = 'Editar reserva';

        return view('admin.reserve.edit', compact('form', 'title'));
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
            return redirect()->route('admin.reserve.index')->with('success', __('Reserva atualizada com sucesso'));
        } catch (Exception $e) {
            if ($e->getCode() == Response::HTTP_BAD_REQUEST) {
                return redirect()->back()->withInput($values)->with('error', $e->getMessage());
            }
            throw $e;
        }
    }
}
