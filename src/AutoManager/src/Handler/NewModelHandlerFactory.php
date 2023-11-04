<?php

declare(strict_types=1);

namespace AutoManager\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class NewModelHandlerFactory
{
    public function __invoke(ContainerInterface $container) : NewModelHandler
    {
        return new NewModelHandler($container->get(TemplateRendererInterface::class));
    }
}
