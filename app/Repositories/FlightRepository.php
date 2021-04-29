<?php

namespace App\Repositories;

use App\Models\Flight;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

class FlightRepository extends BaseRepository implements Contracts\FlightContract
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Flight::class;
    }

    public function getAll(array $filters)
    {
        return $this->model->with([
            'origin',
            'destination',
        ])
            ->where(function ($q) use ($filters) {
                $q->byUuid($filters['code'] ?? null)
                    ->byDate($filters['date'] ?? null)
                    ->byHourOutput($filters['hour_output'] ?? null)
                    ->byQtdStops($filters['qtd_stops'] ?? null)
                    ->byOrigin($filters['airport_origin_id'] ?? null)
                    ->byDestination($filters['airport_destination_id'] ?? null);
            })
            ->orderBy('id', 'desc')->paginate();
    }

    public function updateByUuid($uuid, $data)
    {
        return $this->model->where('uuid', $uuid)->update($data);
    }

    public function pluck()
    {
        return $this->model->orderBy('id')->pluck('uuid', 'id')->toArray();
    }

    public function getReservesAvaliable($id)
    {
        $flight = $this->model->with(['plane', 'reserves'])->find($id);
        $plane = $flight->plane;
        $qtdPassengers = $plane->qtd_passengers;
        $qtdReserves = $flight->reserves->count();
        return $qtdPassengers > $qtdReserves;
    }

    public function getSearch(array $filters)
    {
        list($cities_origin) = explode(' - ', $filters['cities_origin']);
        list($cities_destination) = explode(' - ', $filters['cities_destination']);

        return $this->model->with([
            'origin',
            'destination',
        ])
            ->where(function ($q) use ($filters, $cities_origin, $cities_destination) {
                $q->byDate($filters['date'] ?? null)
                    ->byOrigin($cities_origin ?? null)
                    ->byDestination($cities_destination ?? null);
            })
            ->orderBy('id', 'desc')->paginate();
    }
}
