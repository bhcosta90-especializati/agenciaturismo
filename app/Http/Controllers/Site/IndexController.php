<?php

namespace App\Http\Controllers\Site;

use App\Forms\Site\HomeForm;
use App\Http\Controllers\Controller;
use App\Services\Admin\AirportService;
use App\Services\Admin\CityService;
use Kris\LaravelFormBuilder\FormBuilder;

class IndexController extends Controller
{
    public function __construct(private AirportService $airportService)
    {
        
    }

    public function index(FormBuilder $formBuilder)
    {
        $airports = $this->airportService->getAll();

        return view('site.home.index', compact('airports'));
    }
}
