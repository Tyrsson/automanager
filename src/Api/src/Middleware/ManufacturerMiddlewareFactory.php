<?php

declare(strict_types=1);

namespace Api\Middleware;

use Psr\Container\ContainerInterface;

class ManufacturerMiddlewareFactory
{
    public function __invoke(ContainerInterface $container) : ManufacturerMiddleware
    {
        return new ManufacturerMiddleware();
    }
}
