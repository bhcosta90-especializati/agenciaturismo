<?php

namespace App\Services\Admin;

use App\Repositories\Contracts\FlightContract;
use Illuminate\Http\Request;

class FlightService {

    public function __construct(private FlightContract $repo, private Request $request)
    {
        #    
    }

    public function index(){
        return $this->repo->getAll($this->request->all());
    }

    public function store(array $values)
    {
        return $this->repo->create($values);
    }

    public function delete($id){
        return $this->repo->deleteById($id);
    }

    public function get($id) {
        return $this->repo->getByColumn($id, 'uuid');
    }

    public function update($id, $values) {
        return $this->repo->updateByUuid($id, $values);
    }

    public function pluck() {
        return $this->repo->pluck();
    }

    public function getReserverAvaliable($id)
    {
        return $this->repo->getReservesAvaliable($id);
    }

    public function getSearch(){
        return $this->repo->getSearch($this->request->all());
    }
}