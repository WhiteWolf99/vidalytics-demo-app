<?php

require_once __DIR__.'/vendor/autoload.php';

use Acme\Demo\AppCommand;

$application = new Symfony\Component\Console\Application();
$application->add(new AppCommand());
$application->run();
