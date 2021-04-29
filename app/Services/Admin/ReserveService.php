<?php

namespace App\Services\Admin;

use App\Repositories\Contracts\ReserveContract;
use Illuminate\Http\Request;

class ReserveService {

    public function __construct(private ReserveContract $repo, private Request $request)
    {
        #    
    }

    public function index(){
        return $this->repo->getAll($this->request->all());
    }

    public function status(){
        return $this->repo->status();
    }

    public function store(array $values)
    {
        return $this->repo->create($values);
    }

    public function get($id){
        return $this->repo->getByColumn($id, 'uuid');
    }

    public function update($id, $values){
        return $this->repo->updateByUuid($id, $values);
    }

}