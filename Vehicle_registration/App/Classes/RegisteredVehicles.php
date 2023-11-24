<?php

namespace App\Classes;

class RegisteredVehicles
{
    private int $objectID;
    private int $vehicleModelID;
    private string $vehicleModel;
    private int $vehicleTypeID;
    private string $vehicleType;
    private string $vehicleVIN;
    private string $productionYear;
    private string $registrationNumber;
    private int $vehicleFuelTypeID;
    private string $vehicleFuelType;
    private string $registrationDate;

    public function __construct(array $data)
    {
        $this->objectID = $data['objectID'];
        $this->vehicleModelID = $data['vehicleModelID'];
        $this->vehicleModel = $data['vehicleModel'];
        $this->vehicleTypeID = $data['vehicleTypeID'];
        $this->vehicleType = $data['vehicleType'];
        $this->vehicleVIN = $data['vehicleVIN'];
        $this->productionYear = $data['productionYear'];
        $this->registrationNumber = $data['registrationNumber'];
        $this->vehicleFuelTypeID = $data['vehicleFuelTypeID'];
        $this->vehicleFuelType = $data['vehicleFuelType'];
        $this->registrationDate = $data['registrationDate'];
    }

//GETTERS

    public function getObjectID(): int
    {
        return $this->objectID;
    }

    public function getVehicleModelID(): int
    {
        return $this->vehicleModelID;
    }

    public function getVehicleModel(): string
    {
        return $this->vehicleModel;
    }

    public function getVehicleTypeID(): int
    {
        return $this->vehicleTypeID;
    }

    public function getVehicleType(): string
    {
        return $this->vehicleType;
    }

    public function getVehicleVIN(): string
    {
        return $this->vehicleVIN;
    }

    public function getProductionYear(): string
    {
        return $this->productionYear;
    }

    public function getRegistrationNumber(): string
    {
        return $this->registrationNumber;
    }

    public function getVehicleFuelTypeID(): int
    {
        return $this->vehicleFuelTypeID;
    }

    public function getVehicleFuelType(): string
    {
        return $this->vehicleFuelType;
    }

    public function getRegistrationDate(): string
    {
        return $this->registrationDate;
    }

//    SETTERS
    public function setRegistrationDate(string $registrationDate): void
    {
        $this->registrationDate = $registrationDate;
    }


}