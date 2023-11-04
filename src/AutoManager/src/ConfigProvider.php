<?php

declare(strict_types=1);

namespace AutoManager;

use Laminas\EventManager\EventManager;
use Laminas\EventManager\EventManagerInterface;
use Laminas\EventManager\SharedEventManager;
use Laminas\EventManager\SharedEventManagerInterface;
use Mezzio\Application;
use Mezzio\Container\ApplicationConfigInjectionDelegator;

final class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'routes'       => $this->getRoutes(),
            'templates'    => $this->getTemplates(),
        ];
    }

    public function getDependencies(): array
    {
        return [
            'aliases'   => [// these entries are here to allow calling
                EventManagerInterface::class       => EventManager::class,
                SharedEventManagerInterface::class => SharedEventManager::class,
            ],
            'delegators' => [
                Application::class => [
                    ApplicationConfigInjectionDelegator::class,
                ],
            ],
            'factories' => [
                Middleware\AjaxRequestMiddleware::class          => Middleware\AjaxRequestMiddlewareFactory::class,
                EventManager::class                              => EventManagerFactory::class,
                SharedEventManager::class                        => fn(): SharedEventManager => new SharedEventManager(), // Example of arrow function syntax in php
                Storage\Repository\ManufacturerRepository::class => Storage\Repository\ManufacturerRepositoryFactory::class,
                Storage\Repository\ModelRepository::class        => Storage\Repository\ModelRepositoryFactory::class,
                Storage\Repository\VehicleRepository::class      => Storage\Repository\VehicleRepositoryFactory::class,
            ],
            'invokables' => [
                // These classes do not declare a __contruct() method therefore they do not need a factory
                Storage\Listener\ManufacturerRepositoryListener::class => Storage\Listener\ManufacturerRepositoryListener::class,
                Storage\Listener\ModelRepositoryListener::class        => Storage\Listener\ModelRepositoryListener::class,
                Storage\Listener\VehicleRepositoryListener::class      => Storage\Listener\VehicleRepositoryListener::class,
                Storage\Entity\Manufacturer::class                     => Storage\Entity\Manufacturer::class,
                Storage\Entity\Model::class                            => Storage\Entity\Model::class,
                Storage\Entity\Vehicle::class                          => Storage\Entity\Vehicle::class,
            ],
        ];
    }

    public function getRoutes(): array
    {
        return [
            [
                'name' => 'auto-manager',
                'path' => '/auto/manager',
                'middleware' => [
                    Middleware\ManagerMiddleware::class, // check request for different types of data being added
                    Handler\ManagerHandler::class,
                ],
            ],
            [
                'name' => 'new-manufacturer',
                'path' => '/auto/manager/new/manufacturer',
                'middleware' => Handler\NewManufacturerHandler::class,
            ],
            [
                'name' => 'new-model',
                'path' => '/auto/manager/new/model',
                'middleware' => Handler\NewModelHandler::class,
            ],
            [
                'name' => 'new-vehicle',
                'path' => '/auto/manager/new/vehicle',
                'middleware' => Handler\NewVehicleHandler::class,
            ],
            [
                'name' => 'vehicle-listing',
                'path' => '/auto/list[/{manufacturer:[a-zA-Z]+}[/{model:[a-zA-Z0-9]+}[/{year:\d+}[/id:\d+}]]]]',
                'middleware' => [
                    Middleware\ManufacturerMiddleware::class, // load Manufacturer Data and add it to the request
                    Middleware\ModelMiddleware::class, // load Model Data and add it to the request
                    Middleware\VehicleMiddleware::class, // load Vehicle Data and add it to the request
                    Handler\VehicleListingHandler::class, // use loaded data to build a response
                    //Middleware\ManagerMiddleware::class,
                ],
            ],
        ];
    }

    public function getTemplates(): array
    {
        return [
            'paths' => [
                'auto-manager' => [__DIR__ . '/../templates/auto-manager'],
            ],
        ];
    }
}
