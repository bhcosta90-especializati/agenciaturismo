<?php

namespace App\Repositories\Contracts;

interface FlightContract
{
    public function getAll(array $filters);

    public function updateByUuid($uuid, $data);

    public function pluck();

    public function getReservesAvaliable($id);

    public function getSearch(array $filters);
}
