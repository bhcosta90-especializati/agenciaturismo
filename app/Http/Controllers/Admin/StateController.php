<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\StateService;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function __construct(private StateService $service)
    {
        
    }

    public function index()
    {
        $data = $this->service->index();

        return view('admin.state.index', compact('data'));
    }
}
