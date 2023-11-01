<?php

declare(strict_types=1);

namespace AutoManager\Middleware;

use AutoManager\Storage\Repository\ManufacturerRepository;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class ActionMiddlewareFactory
{
    public function __invoke(ContainerInterface $container) : ActionMiddleware
    {
        return new ActionMiddleware(
            $container->get(TemplateRendererInterface::class),
            $container->get(ManufacturerRepository::class)
        );
    }
}
