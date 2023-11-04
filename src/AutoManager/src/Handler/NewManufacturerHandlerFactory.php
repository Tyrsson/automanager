<?php

declare(strict_types=1);

namespace AutoManager\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class NewManufacturerHandlerFactory
{
    public function __invoke(ContainerInterface $container) : NewManufacturerHandler
    {
        return new NewManufacturerHandler($container->get(TemplateRendererInterface::class));
    }
}
