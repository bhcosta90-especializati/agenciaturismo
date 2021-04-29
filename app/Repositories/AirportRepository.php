<?php

namespace App\Repositories;

use App\Models\Airport;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

class AirportRepository extends BaseRepository implements Contracts\AirportContract
{
    public function model()
    {
        return Airport::class;
    }

    public function getAll(array $filters){
        return $this->model
            ->with(['city.state'])
            ->byCity($filters['city_id'] ?? null)
            ->byName($filters['name'] ?? null)
            ->paginate();
    }

    public function getAllPaginate(array $filters){
        return $this->model
            ->with(['city.state'])
            ->byCity($filters['city_id'] ?? null)
            ->byName($filters['name'] ?? null)
            ->paginate();
    }

    public function pluck() {
        return $this->model->orderBy('name')->pluck('name', 'id')->toArray();
    }
}
