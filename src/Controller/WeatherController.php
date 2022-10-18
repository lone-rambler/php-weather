<?php

namespace App\Controller;

use App\Repository\LocationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Location;
use App\Repository\MeasurementRepository;

class WeatherController extends AbstractController
{
    public function cityAction(Location $city, MeasurementRepository $measurementRepository): Response
    {
        $measurements = $measurementRepository->findByLocation($city);
        return $this->render('weather/city.html.twig', [
            'location' => $city,
            'measurements' => $measurements,
        ]);
    }

    public function countryCityAction(String $countryCode, String $city, LocationRepository $locationRepository, MeasurementRepository $measurementRepository): Response{
        $location = $locationRepository->findByCountryCity($countryCode, $city);
        $measurements = $measurementRepository->findByLocation($location);
        return $this->render('weather/city.html.twig', [
            'location' => $location,
            'measurements' => $measurements,
        ]);
    }


//    #[Route('/weather', name: 'app_weather')]
//    public function index(): Response
//    {
//        return $this->render('weather/index.html.twig', [
//            'controller_name' => 'WeatherController',
//        ]);
//    }
}
