<?php

namespace App\Services\Admin;

use App\Repositories\Contracts\BrandContract;
use Illuminate\Http\Request;

class BrandService {

    public function __construct(private BrandContract $repo, private Request $request)
    {
        #    
    }

    public function index(){
        return $this->repo->getAll($this->request->all());
    }

    public function store(array $data){
        $this->repo->create($data);
    }

    public function delete($id){
        return $this->repo->deleteById($id);
    }

    public function get($id) {
        return $this->repo->getByid($id);
    }

    public function update($id, $values) {
        return $this->repo->updateById($id, $values);
    }

    public function pluck(){
        return $this->repo->pluck();
    }
}