<?php

namespace App\Services\Admin;

use App\Repositories\Contracts\StateContract;
use Illuminate\Http\Request;

class StateService {

    public function __construct(private StateContract $repo, private Request $request)
    {
        #    
    }

    public function index(){
        return $this->repo->getAll($this->request->all());
    }

    public function pluck(){
        return $this->repo->pluck();
    }

    public function get($id)
    {
        return $this->repo->getById($id);
    }
}