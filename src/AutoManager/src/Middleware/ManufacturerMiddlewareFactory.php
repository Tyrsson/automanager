<?php

declare(strict_types=1);

namespace AutoManager\Middleware;

use AutoManager\Storage\Repository\ManufacturerRepository;
use Psr\Container\ContainerInterface;

class ManufacturerMiddlewareFactory
{
    public function __invoke(ContainerInterface $container) : ManufacturerMiddleware
    {
        return new ManufacturerMiddleware($container->get(ManufacturerRepository::class));
    }
}
