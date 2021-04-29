<?php

namespace App\Repositories;

use App\Models\State;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

class StateRepository extends BaseRepository implements Contracts\StateContract
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return State::class;
    }

    public function getAll(array $filters)
    {
        return $this->model->with('cities')->byName($filters['name'] ?? null)->paginate();
    }

    public function pluck() {
        return $this->model->orderBy('name')->pluck('name', 'id')->toArray();
    }
}
