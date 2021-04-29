<?php

namespace App\Repositories;

use App\Models\Plane;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

class PlaneRepository extends BaseRepository implements Contracts\PlaneContract
{
    public function model()
    {
        return Plane::class;
    }

    public function getAll(array $filters){
        return $this->model->with(['brand'])
            ->byBrand($filters['brand_id'] ?? null)
            ->byClass($filters['class'] ?? null)
            ->bySKU($filters['sku'] ?? null)
            ->paginate();
    }

    public function pluck()
    {
        $result = $this->model->orderBy('sku')->get();
        $ret = [];
        foreach($result as $rs){
            $class = $rs->class($rs->class);
            $ret[$rs->id] = "{$rs->sku} - {$class} - {$rs->qtd_passengers} passagueiro(s)";
        }

        return $ret;
    }

    public function class(){
        return $this->model->class();
    }
}
