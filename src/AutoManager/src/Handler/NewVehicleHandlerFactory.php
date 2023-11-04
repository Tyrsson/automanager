<?php

declare(strict_types=1);

namespace AutoManager\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class NewVehicleHandlerFactory
{
    public function __invoke(ContainerInterface $container) : NewVehicleHandler
    {
        return new NewVehicleHandler($container->get(TemplateRendererInterface::class));
    }
}
