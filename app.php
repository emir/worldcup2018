#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;
use WorldCup2018\Command\FixturesCommand;

$application = new Application();
$client = new GuzzleHttp\Client();

$application->add(new FixturesCommand($client));
$application->run();
