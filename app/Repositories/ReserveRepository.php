<?php

namespace App\Repositories;

use App\Models\Reserve;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

class ReserveRepository extends BaseRepository implements Contracts\ReserveContract
{
    public function model()
    {
        return Reserve::class;
    }

    public function getAll(array $filters)
    {
        return $this->model->with(['user', 'flight'])
            ->byUserName($filters['name'] ?? null)
            ->byUserEmail($filters['email'] ?? null)
            ->byFlightUuid($filters['flight_id'] ?? null)
            ->byFlightDate($filters['flight_date'] ?? null)
            ->byStatus($filters['status'] ?? null)
            ->paginate();
    }

    public function status(){
        return $this->model->status();
    }

    public function updateByUuid($uuid, $values){
        return $this->model->where("uuid", $uuid)->update($values);
    }
}
