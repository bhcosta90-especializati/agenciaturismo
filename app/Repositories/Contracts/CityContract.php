<?php

namespace App\Repositories\Contracts;

interface CityContract
{
    public function getAllPaginate(array $filters);

    public function getAll(array $filters);

    public function pluck();
}
