<?php
declare(strict_types=1);

namespace App\Classes;

class VehicleType
{
    private int $id;
    private string $vehicleType;

    public function __construct($data)
    {
        $this->id = $data['id'];
        $this->vehicleType = $data['vehicleType'];
    }

    public function getVehicleTypeID(): int
    {
        return $this->id;
    }

    public function getVehicleType(): string
    {
        return $this->vehicleType;
    }
}