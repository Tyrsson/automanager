<?php

declare(strict_types=1);

namespace AutoManager\Storage\Repository;

use AutoManager\Storage\Entity\Manufacturer;
use AutoManager\Storage\Listener\ManufacturerRepositoryListener;
use AutoManager\Storage\Schema; // This defines our table name
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\EventManager\EventManagerInterface;
use Laminas\Hydrator\ReflectionHydrator; // use this hydrator because since it uses Reflection, it can Hydrate private propteries
use Psr\Container\ContainerInterface; // This provides type hinting for the PSR-11 Container
use Webinertia\Db; // I am using this here to provide an example of different ways you can use Namespaces

final class ManufacturerRepositoryFactory
{
    public function __invoke(ContainerInterface $container): ManufacturerRepository
    {
        return new ManufacturerRepository(
            new ReflectionHydrator(),
            new Db\TableGateway(
                Schema::MANUFACTURER_TABLE,
                $container->get(AdapterInterface::class), // This reads the 'db' array from the config
                null, // we are not passing an EventFeature object
                new HydratingResultSet(
                    new ReflectionHydrator(),
                    $container->get(Manufacturer::class)
                ),
                null, // we are not passing an explicit Sql object, the Tablegateway will create an instance bound to the passed table
                $container->has(EventManagerInterface::class) ? $container->get(EventManagerInterface::class) : null, // if we have an event manager pass it
                $container->has(ManufacturerRepositoryListener::class) ? $container->get(ManufacturerRepositoryListener::class) : null // if there is one pass it
            )
        );
    }
}
