<?php

declare(strict_types=1);

namespace Api\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class ManufacturerHandlerFactory
{
    public function __invoke(ContainerInterface $container) : ManufacturerHandler
    {
        return new ManufacturerHandler($container->get(TemplateRendererInterface::class));
    }
}
