<?php
use Zend\ServiceManager\ServiceManager;
use App\Commands\MyCommand;

return [
    'factories' => [
        MyCommand::class => function (ServiceManager $serviceManager) {
            return new MyCommand();
        },
    ],
];