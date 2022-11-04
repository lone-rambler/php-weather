<?php

namespace App\Services;

use App\Entity\Location;
use App\Repository\LocationRepository;
use App\Repository\MeasurementRepository;

class WeatherUtil{

    private LocationRepository $locationRepository;
    private MeasurementRepository $measurementRepository;

    public function __construct(LocationRepository $locationRepository, MeasurementRepository $measurementRepository)
    {
        $this->locationRepository = $locationRepository;
        $this->measurementRepository = $measurementRepository;
    }

    public function getWeatherForLocationId($locationId){
        $location = $this->locationRepository->findByLocationId($locationId);
        return $this->measurementRepository->findByLocation($location);
    }

    public function getWeatherForLocation($location){
        return $this->measurementRepository->findByLocation($location);
    }

    public function getWeatherForCountryAndCity($countryCode, $cityName) : array{
        $location = $this->locationRepository->findByCountryCity($countryCode, $cityName);

        return $this->getWeatherForLocation($location);
    }
}