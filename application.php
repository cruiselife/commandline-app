#!C:\wamp\bin\php\php7.3.12\php.exe -q
<?php

require __DIR__ . '/vendor/autoload.php';

use Zend\ServiceManager\ServiceManager;
use Symfony\Component\Console\Application;


$application    = new Application('My Application');
$serviceManager = new ServiceManager(require __DIR__ . '/config/services.php');

foreach (require __DIR__ . '/config/commands.php' as $commandName) {
    $application->add($serviceManager->get($commandName));
}

try {
    $application->run();
} catch (\Exception $e) {
    // Handle application's exceptions
}