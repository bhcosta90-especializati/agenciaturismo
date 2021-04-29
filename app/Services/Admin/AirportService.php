<?php

namespace App\Services\Admin;

use App\Repositories\Contracts\AirportContract;
use Illuminate\Http\Request;

class AirportService {

    public function __construct(private AirportContract $repo, private Request $request)
    {
        #    
    }

    public function index(){
        return $this->repo->getAllPaginate($this->request->all());
    }

    public function getAll()
    {
        return $this->repo->getAll($this->request->all());
    }

    public function store($data) {
        return $this->repo->create($data);
    }

    public function delete($id){
        return $this->repo->deleteById($id);
    }

    public function update($id, $data){
        return $this->repo->updateById($id, $data);
    }

    public function get($id)
    {
        return $this->repo->getById($id);
    }

    public function pluck()
    {
        return $this->repo->pluck('name', 'id');
    }
}