<?php
declare(strict_types=1);

namespace App\Classes;

class VehicleFuelType
{
    private int $id;
    private string $vehicleFuelType;

    public function __construct($data)
    {
        $this->id = $data['id'];
        $this->vehicleFuelType = $data['vehicleFuelType'];

    }

    public function getVehicleFuelTypeID(): int
    {
        return $this->id;
    }

    public function getVehicleFuelType(): string
    {
        return $this->vehicleFuelType;
    }

}