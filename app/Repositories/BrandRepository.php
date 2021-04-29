<?php

namespace App\Repositories;

use App\Models\Brand;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

class BrandRepository extends BaseRepository implements Contracts\BrandContract
{
    public function model()
    {
        return Brand::class;
    }

    public function getAll(array $filters){
        return $this->model
            ->with(['planes'])
            ->byName($filters['name'] ?? null)
            ->orderBy('name')->paginate();
    }
    
    public function pluck() {
        return $this->model->orderBy('name')->pluck('name', 'id')->toArray();
    }
}
