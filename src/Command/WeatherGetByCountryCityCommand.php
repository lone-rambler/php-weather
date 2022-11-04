<?php

namespace App\Command;

use App\Services\WeatherUtil;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'weather:getByCountryCity',
    description: 'Zwraca prognozę pogody dla lokacji o podanym kodzie państwa i nazwie miasta.',
)]
class WeatherGetByCountryCityCommand extends Command
{
    private WeatherUtil $weatherUtil;

    public function __construct(WeatherUtil $weatherUtil, string $name = null)
    {
        $this->weatherUtil = $weatherUtil;
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this
            ->addArgument('countryCode', InputArgument::REQUIRED, 'Kod państwa np. PL')
            ->addArgument('city', InputArgument::REQUIRED, 'Nazwa miasta');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $coutryCode = $input->getArgument('countryCode');
        $city = $input->getArgument('city');

        $measurements = $this->weatherUtil->getWeatherForCountryAndCity($coutryCode, $city);

        foreach ($measurements as $measurement) {
            $io->success($measurement->__toString());
        }

        return Command::SUCCESS;
    }
}
