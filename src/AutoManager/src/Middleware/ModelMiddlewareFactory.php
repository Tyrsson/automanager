<?php

declare(strict_types=1);

namespace AutoManager\Middleware;

use AutoManager\Storage\Repository\ModelRepository;
use Psr\Container\ContainerInterface;

class ModelMiddlewareFactory
{
    public function __invoke(ContainerInterface $container) : ModelMiddleware
    {
        return new ModelMiddleware($container->get(ModelRepository::class));
    }
}
