<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\CityService;
use App\Services\Admin\StateService;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function __construct(
        private CityService $service,
        private StateService $stateService
    ) {
    }

    public function index(Request $request)
    {
        $data = $this->service->index();
        $states = $this->stateService->pluck();
        $breadcrumbs = $request->state_id ? $this->stateService->get($request->state_id) : null;
        return view('admin.city.index', compact('data', 'states', 'breadcrumbs'));
    }
}
