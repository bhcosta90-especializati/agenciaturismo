<?php

namespace App\Repositories\Contracts;

interface PlaneContract
{
    public function getAll(array $filters);

    public function pluck();

    public function class();
}
