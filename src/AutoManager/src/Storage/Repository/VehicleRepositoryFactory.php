<?php

declare(strict_types=1);

namespace AutoManager\Storage\Repository;

use AutoManager\Storage\Entity\Vehicle;
use AutoManager\Storage\Listener\VehicleRepositoryListener;
use AutoManager\Storage\Schema;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\EventManager\EventManagerInterface;
use Laminas\Hydrator\ReflectionHydrator;
use Psr\Container\ContainerInterface;
use Webinertia\Db;

final class VehicleRepositoryFactory
{
    public function __invoke(ContainerInterface $container): VehicleRepository
    {
        return new VehicleRepository(
            new ReflectionHydrator(),
            new Db\TableGateway(
                Schema::VEHICLE_TABLE,
                $container->get(AdapterInterface::class), // This reads the 'db' array from the config
                null, // we are not passing an EventFeature object
                new HydratingResultSet(
                    new ReflectionHydrator(),
                    $container->get(Vehicle::class)
                ),
                null, // we are not passing an explicit Sql object, the Tablegateway will create an instance bound to the passed table
                $container->has(EventManagerInterface::class) ? $container->get(EventManagerInterface::class) : null, // if we have an event manager pass it
                $container->has(VehicleRepositoryListener::class) ? $container->get(VehicleRepositoryListener::class) : null // if there is one pass it
            )
        );
    }
}
