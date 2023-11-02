<?php

declare(strict_types=1);

namespace AutoManager\Middleware;

use Psr\Container\ContainerInterface;

class VehicleMiddlewareFactory
{
    public function __invoke(ContainerInterface $container) : VehicleMiddleware
    {
        return new VehicleMiddleware();
    }
}
