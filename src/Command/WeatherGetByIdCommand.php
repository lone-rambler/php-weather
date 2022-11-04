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
    name: 'weather:getById',
    description: 'Zwraca prognozę pogody dla lokacji o podanym ID.',
)]
class WeatherGetByIdCommand extends Command
{
    private WeatherUtil $weatherUtil;

    public function __construct(WeatherUtil $weatherUtil, string $name = null)
    {
        $this->weatherUtil = $weatherUtil;
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this->addArgument('locationId', InputArgument::REQUIRED, 'Id lokacji');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $locationId = $input->getArgument('locationId');

        $measurements = $this->weatherUtil->getWeatherForLocationId($locationId);

        foreach ($measurements as $measurement) {
            $io->success($measurement->__toString());
        }

        return Command::SUCCESS;
    }
}
