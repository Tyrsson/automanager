<?php

declare(strict_types=1);

namespace AutoManager\Middleware;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class ManagerMiddlewareFactory
{
    public function __invoke(ContainerInterface $container) : ManagerMiddleware
    {
        return new ManagerMiddleware($container->get(TemplateRendererInterface::class));
    }
}
