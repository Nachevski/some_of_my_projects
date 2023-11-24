<?php
declare(strict_types=1);

namespace App\Classes;

class VehicleModel
{
    private int $id;
    private string $vehicleModel;

    public function __construct($data)
    {
        $this->id = $data['id'];
        $this->vehicleModel = $data['vehicleModel'];

    }

    public function getVehicleModelID(): int
    {
        return $this->id;
    }

    public function getVehicleModel(): string
    {
        return $this->vehicleModel;
    }
}