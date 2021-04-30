<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Services\Admin\AirportService;
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
