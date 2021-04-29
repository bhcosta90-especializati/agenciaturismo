<?php

namespace App\Services\Admin;

use App\Repositories\Contracts\CityContract;
use Illuminate\Http\Request;

class CityService {

    public function __construct(private CityContract $repo, private Request $request)
    {
        #    
    }

    public function index(){
        return $this->repo->getAllPaginate($this->request->all());
    }

    public function getAllCities(){
        return $this->repo->getAll($this->request->all());
    }

    public function get($id){
        return $this->repo->getById($id);
    }

    public function pluck(){
        return $this->repo->pluck();
    }

}