<?php

namespace App\Repositories\Contracts;

interface ReserveContract
{
    public function getAll(array $filters);

    public function status();
}
