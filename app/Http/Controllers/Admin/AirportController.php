<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AirportService;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Forms\Admin\AirportForm as Form;
use App\Services\Admin\CityService;
use Exception;
use Illuminate\Http\Response;

class AirportController extends Controller
{
    public function __construct(
        private AirportService $service,
        private CityService $cityService
    ) {
        
    }

    public function index(Request $request)
    {
        $data = $this->service->index();
        $title = 'Aeroportos';
        $city = $breadcrumbs = $this->cityService->get($request->city_id);

        return view('admin.airport.index', compact('data', 'title', 'city', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder, Request $request)
    {
        $form = $formBuilder->create(Form::class, [
            'method' => 'POST',
            'url' => route('admin.airport.store')
        ])->add('btn', 'submit', [
            "attr" => ['class' => 'btn btn-primary'],
            'label' => __('Cadastrar')
        ]);
        $title = 'Cadastrar aeroporto';
        $breadcrumbs = $this->cityService->get($request->city_id);

        return view('admin.airport.create', compact('form', 'title', 'breadcrumbs'));
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
            'url' => route('admin.airport.store')
        ]);

        $form->redirectIfNotValid();

        $values = $form->getFieldValues();
        try {
            $this->service->store($values);
            return redirect()->route('admin.airport.index', ['city_id' => $values['city_id']])->with('success', __('Cadastro realizado com sucesso'));
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
            'url' => route('admin.airport.update', $id),
            'model' => $obj = $this->service->get($id)
        ])->add('btn', 'submit', [
            "attr" => ['class' => 'btn btn-primary'],
            'label' => __('Editar')
        ]);
        $title = 'Editar marca de avião';
        $breadcrumbs = $this->cityService->get($obj->city_id);

        return view('admin.airport.edit', compact('form', 'title', 'breadcrumbs'));
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
        $obj = $this->service->get($id);

        $form = $formBuilder->create(Form::class, [
            'method' => 'PUT',
            'url' => route('admin.airport.update', $id),
        ]);

        $form->redirectIfNotValid();

        $values = $form->getFieldValues();
        try {
            $this->service->update($id, $values);
            return redirect()->route('admin.airport.index', ['city_id' => $obj->city_id])->with('success', __('Atualizado com sucesso'));
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
            $rs = $this->service->get($id);
            $this->service->delete($id);
            return redirect()->route('admin.airport.index', ['city_id' => $rs->city_id])->with('success', __('Aeroporto deletado com sucesso'));
        } catch (Exception $e) {
            if ($e->getCode() == Response::HTTP_BAD_REQUEST) {
                return redirect()->back()->with('error', $e->getMessage());
            }
            throw $e;
        }
    }
}
