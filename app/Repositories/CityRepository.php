<?php

namespace App\Repositories;

use App\Models\City;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

class CityRepository extends BaseRepository implements Contracts\CityContract
{
    public function model()
    {
        return City::class;
    }

    public function getAllPaginate(array $filters)
    {
        return $this->model->with(['airports'])
            ->byState($filters['state_id'] ?? null)
            ->byName($filters['name'] ?? null)
            ->paginate();
    }

    public function getAll(array $filters)
    {
        return $this->model->with(['state'])
            ->byState($filters['state_id'] ?? null)
            ->byName($filters['name'] ?? null)
            ->get();
    }

    public function pluck(){
        return $this->model->orderBy('name')->pluck('name', 'id')->toArray();
    }
}
