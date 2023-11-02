<?php

declare(strict_types=1);

namespace AutoManager;

use AutoManager\Storage\Entity\Manufacturer;
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
                EventManager::class       => EventManagerFactory::class,
                // Example of arrow function syntax in php
                SharedEventManager::class => fn(): SharedEventManager => new SharedEventManager(),
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
                'name' => 'automanager',
                'path' => '/automanager/list[/{manufacturer:[a-zA-Z]+}[/{model:[a-zA-Z0-9]+}[/{year:\d+}[/id:\d+}]]]]',
                'middleware' => [
                    Middleware\ManufacturerMiddleware::class,
                    Middleware\ModelMiddleware::class,
                    Middleware\VehicleMiddleware::class,
                    Middleware\ManagerMiddleware::class,
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
