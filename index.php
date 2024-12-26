<?php

use App\JokeApi;
use App\JokeCommand;
use Hex\Joker;
use Symfony\Component\Console\Application;

require_once __DIR__ . '/vendor/autoload.php';

$application = new Application();
$application->add(new JokeCommand(new Joker(new JokeApi())));
$application->run();
