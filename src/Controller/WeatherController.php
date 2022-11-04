<?php

namespace App\Controller;

use App\Repository\LocationRepository;
use App\Services\WeatherUtil;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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

    public function countryCityAction(string $countryCode, string $city, LocationRepository $locationRepository, MeasurementRepository $measurementRepository): Response
    {
        $location = $locationRepository->findByCountryCity($countryCode, $city);
        $measurements = $measurementRepository->findByLocation($location);
        return $this->render('weather/city.html.twig', [
            'location' => $location,
            'measurements' => $measurements,
        ]);
    }

    #[Route('/weather/service/{countryCode}/{city}')]
    public function weatherServiceUtil(string $countryCode, string $city, WeatherUtil $weatherUtil): Response
    {
        $measurements = $weatherUtil->getWeatherForCountryAndCity($countryCode, $city);
        return $this->render('weather/service.html.twig', [
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
