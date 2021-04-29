<?php

namespace App\Http\Controllers\Site;

use App\Forms\Admin\ReserveForm;
use App\Http\Controllers\Controller;
use App\Models\Reserve;
use App\Services\Admin\FlightService;
use App\Services\Admin\ReserveService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Kris\LaravelFormBuilder\FormBuilder;

class FlightController extends Controller
{
    public function __construct(private FlightService $flightService, private ReserveService $reserveService)
    {
        
    }
    public function search(Request $request){
        $data = $this->flightService->getSearch();
        $filters = $request->all();
        list(,$cityOrigin, $airportOrigin) = explode('-', $request->cities_origin);
        list(,$cityDestination, $airportDestination) = explode('-', $request->cities_destination);
        $filters['cities_origin'] = "{$cityOrigin} - {$airportOrigin}";
        $filters['cities_destination'] = "{$cityDestination} - {$airportDestination}";

        return view('site.flight.search', compact('data', 'filters'));
    }

    public function show($uuid){
        $obj = $this->flightService->get($uuid);
        return view('site.flight.show', compact('obj'));
    }

    public function reserve(FormBuilder $formBuilder, $uuid){
        $objFlight = $this->flightService->get($uuid);

        request()->request->add([
            'user_id' => auth()->user()->id, 
            'flight_id' => $objFlight->id,
            'date_reserved' => Carbon::now(),
            'status' => Reserve::STATUS_RESERVED
        ]);

        $form = $formBuilder->create(ReserveForm::class);
        $form->redirectIfNotValid();
        $values = $form->getFieldValues();

        try {
            $reserve = $this->reserveService->store($form->getFieldValues());
            return redirect()->route('site.flight.confirmation', $reserve->uuid)->with('success', __('Reservado com sucesso'));
        } catch (Exception $e) {
            if ($e->getCode() == Response::HTTP_BAD_REQUEST) {
                return redirect()->back()->withInput($values)->with('error', $e->getMessage());
            }
            throw $e;
        }
    }

    public function confirmation($id){
        $obj = $this->reserveService->get($id);
        return view('site.flight.confirmation', compact('obj'));
    }
}
