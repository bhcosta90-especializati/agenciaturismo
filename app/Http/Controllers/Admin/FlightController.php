<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\FlightService;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Forms\Admin\FlightForm as Form;
use App\Services\Admin\AirportService;
use Exception;
use Illuminate\Http\Response;

class FlightController extends Controller
{
    public function __construct(
        private FlightService $service,
        private AirportService $airportService
    ) {
        
    }

    public function index(Request $request)
    {
        $data = $this->service->index();
        $title = 'Vôos';
        $airports = $this->airportService->pluck();

        return view('admin.flight.index', compact('data', 'airports'));
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
            'url' => route('admin.flight.store')
        ])->add('btn', 'submit', [
            "attr" => ['class' => 'btn btn-primary'],
            'label' => __('Cadastrar')
        ]);
        $title = 'Cadastrar voo';

        return view('admin.flight.create', compact('form', 'title'));
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
            'url' => route('admin.flight.store')
        ]);

        $form->redirectIfNotValid();

        $values = $form->getFieldValues();
        try {
            $this->service->store($values);
            return redirect()->route('admin.flight.index')->with('success', __('Cadastro realizado com sucesso'));
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
            'url' => route('admin.flight.update', $id),
            'model' => $breadcrumbs = $this->service->get($id)
        ])->add('btn', 'submit', [
            "attr" => ['class' => 'btn btn-primary'],
            'label' => __('Editar')
        ]);
        $title = 'Editar marca de avião';

        return view('admin.flight.edit', compact('form', 'title', 'breadcrumbs'));
    }

    public function show($id){
        $title = 'Detalhes do voo';
        $obj = $breadcrumbs = $this->service->get($id);
        return view('admin.flight.show', compact('obj', 'title', 'breadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FormBuilder $formBuilder, $id)
    {
        $form = $formBuilder->create(Form::class, [
            'method' => 'PUT',
        ]);

        $form->redirectIfNotValid();

        $values = $form->getFieldValues();
        try {
            $this->service->update($id, $values);
            return redirect()->route('admin.flight.index')->with('success', __('Atualizado com sucesso'));
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
            return redirect()->route('admin.flight.index')->with('success', __('Vôo deletado com sucesso'));
        } catch (Exception $e) {
            if ($e->getCode() == Response::HTTP_BAD_REQUEST) {
                return redirect()->back()->with('error', $e->getMessage());
            }
            throw $e;
        }
    }
}
