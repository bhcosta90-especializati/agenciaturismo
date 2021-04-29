<?php

namespace App\Repositories\Contracts;

interface StateContract
{
    public function getAll(array $filters);

    public function pluck();
}
