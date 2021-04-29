<?php

namespace App\Repositories\Contracts;

interface AirportContract
{
    public function getAll(array $filters);

    public function getAllPaginate(array $filters);

    public function pluck();
}
