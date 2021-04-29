<?php

namespace App\Repositories\Contracts;

interface BrandContract
{
    public function getAll(array $filters);

    public function pluck();
}
