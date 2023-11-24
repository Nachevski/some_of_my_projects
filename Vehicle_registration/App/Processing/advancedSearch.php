<?php
declare(strict_types=1);
function advancedSearch($keyword): array
{
//    YOU CAN TRY WITH FEW WORDS FOR DIFFERENT RECORDS AND WILL RETURN EVERYTHING ITS FINDS
//    AU LF ME => WILL RETURN AUDI, GOLF AND MERCEDES AND ELSE IF FOUND
//    FROM MODELS, VIN NUMBER OR REGISTRATION
    $keyword = strtolower($keyword);
    $keywords = [];
    $dataObjects = $_SESSION['RegisteredVehicles'];
    $matchedObjects = [];
    $keywords = explode(' ', $keyword);

    foreach ($dataObjects as $key => $record) {
        $modelMatched = false;
        $VINMatched = false;
        $regMatched = false;

        $model = strtolower($record->getVehicleModel());
        for ($i = 0; $i < count($keywords); $i++) {
            if (strstr($model, $keywords[$i])) {
                $modelMatched = true;
                break;
            }
        }

        $VIN = strtolower($record->getVehicleVIN());
        for ($i = 0; $i < count($keywords); $i++) {
            if (strstr($VIN, $keywords[$i])) {
                $VINMatched = true;
                break;
            }
        }

        $RegNumber = strtolower($record->getRegistrationNumber());
        for ($i = 0; $i < count($keywords); $i++) {
            if (strstr($RegNumber, $keywords[$i])) {
                $regMatched = true;
                break;
            }
        }
        if ($modelMatched || $VINMatched || $regMatched) {
            $matchedObjects += array($key => $record);
        }
    }
    return $matchedObjects;
}