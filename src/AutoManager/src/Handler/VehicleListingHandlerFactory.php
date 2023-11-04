<?php

declare(strict_types=1);

namespace AutoManager\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class VehicleListingHandlerFactory
{
    public function __invoke(ContainerInterface $container) : VehicleListingHandler
    {
        return new VehicleListingHandler($container->get(TemplateRendererInterface::class));
    }
}
