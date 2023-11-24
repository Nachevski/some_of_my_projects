<?php
declare(strict_types=1);

namespace App\Database;

class SQLQuery
{
    protected object|null $connection;

    public function __construct()
    {
        $this->connection = Database::connect();
    }

    public function getAllVehicles(): array|null
    {
        $query = 'SELECT registrations.id as objectID,
                         VM.id as vehicleModelID,
		                 VM.model as vehicleModel,
		                 VT.id AS vehicleTypeID,
                         VT.type AS vehicleType,
                         vehicle_chassis_number AS vehicleVIN,
                         vehicle_production_year as productionYear,
                         registration_number AS registrationNumber,
                         FT.id as vehicleFuelTypeID,
                         FT.type as vehicleFuelType,
                         registration_to as registrationDate
                        FROM registrations
                    JOIN vehicle_model AS VM ON vehicle_model_id = VM.id
                    JOIN vehicle_type AS VT ON vehicle_type_id = VT.id
                    JOIN fuel_type AS FT on fuel_type_id = FT.id
                    ORDER BY registrations.id ASC;';
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getLastAddedVehicle(): array|null
    {
        $query = 'SELECT registrations.id as objectID,
                         VM.id as vehicleModelID,
		                 VM.model as vehicleModel,
		                 VT.id AS vehicleTypeID,
                         VT.type AS vehicleType,
                         vehicle_chassis_number AS vehicleVIN,
                         vehicle_production_year as productionYear,
                         registration_number AS registrationNumber,
                         FT.id as vehicleFuelTypeID,
                         FT.type as vehicleFuelType,
                         registration_to as registrationDate
                        FROM registrations
                    JOIN vehicle_model AS VM ON vehicle_model_id = VM.id
                    JOIN vehicle_type AS VT ON vehicle_type_id = VT.id
                    JOIN fuel_type AS FT on fuel_type_id = FT.id
                    ORDER BY objectID DESC
                    LIMIT 1';
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function saveNewRegistration($data)
    {
        $query = 'INSERT INTO registrations (fuel_type_id, vehicle_type_id, vehicle_model_id, vehicle_chassis_number, vehicle_production_year, registration_number, registration_to)
                    VALUES(:vehicleFuelType, :vehicleType, :vehicleModel, :vehicleVIN, :productionYear, :registrationNumber, :registrationDate)';
        $statement = $this->connection->prepare($query);
        $statement->execute($data);
    }

    public function getAdmins(): array|null
    {
        $query = 'SELECT * FROM admins';
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getVehicleFuelTypes(): array|null
    {
        $query = 'SELECT id, type AS vehicleFuelType FROM fuel_type';
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getVehicleModels(): array|null
    {
        $query = 'SELECT id, model AS vehicleModel FROM vehicle_model';
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getVehicleTypes(): array|null
    {
        $query = 'SELECT id, type AS vehicleType FROM vehicle_type';
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function insertNewModel($newModel)
    {
        $query = 'INSERT INTO vehicle_model (model)
                    VALUES (:model)';
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':model', $newModel);
        $statement->execute();
    }

    public function getLastInsertedID()
    {
        return $this->connection->lastInsertId();
    }

    public function deleteRecord($id)
    {
        $query = 'DELETE FROM registrations WHERE id = :id';
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->execute();
    }

    public function editRecord($data)
    {
        $query = 'UPDATE registrations 
                    SET fuel_type_id = :vehicleFuelType, 
                        vehicle_type_id = :vehicleType,
                        vehicle_model_id = :vehicleModel,
                        vehicle_chassis_number = :vehicleVIN,
                        vehicle_production_year = :productionYear,
                        registration_number = :registrationNumber, 
                        registration_to = :registrationDate
                    WHERE id = :recordID;';
        $statement = $this->connection->prepare($query);
        $statement->execute($data);
    }

    public function extendRegistrationDate($data)
    {
        $query = 'UPDATE registrations 
                    SET registration_to = :registrationDate
                    WHERE id = :recordID;';
        $statement = $this->connection->prepare($query);
        $statement->execute($data);
    }

}