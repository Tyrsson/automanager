<?php

declare(strict_types=1);

namespace AutoManager\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class ManagerHandlerFactory
{
    public function __invoke(ContainerInterface $container) : ManagerHandler
    {
        return new ManagerHandler($container->get(TemplateRendererInterface::class));
    }
}
