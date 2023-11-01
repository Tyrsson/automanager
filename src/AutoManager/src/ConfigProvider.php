<?php

declare(strict_types=1);

namespace AutoManager;

use Laminas\EventManager\EventManager;
use Laminas\EventManager\EventManagerInterface;
use Laminas\EventManager\SharedEventManager;
use Laminas\EventManager\SharedEventManagerInterface;

final class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
        ];
    }

    public function getDependencies(): array
    {
        return [
            'aliases'   => [// these entries are here to allow calling
                EventManagerInterface::class       => EventManager::class,
                SharedEventManagerInterface::class => SharedEventManager::class,
            ],
            'factories' => [
                EventManager::class       => EventManagerFactory::class,
                // Example of arrow function syntax in php
                SharedEventManager::class => fn(): SharedEventManager => new SharedEventManager(),
            ],
            'invokables' => [
                // These classes do not declare a __contruct() method therefore they do not need a factory
                Storage\Listener\ManufacturerRepositoryListener::class => Storage\Listener\ManufacturerRepositoryListener::class,
                Storage\Listener\ModelRepositoryListener::class        => Storage\Listener\ModelRepositoryListener::class,
            ],
        ];
    }
}
