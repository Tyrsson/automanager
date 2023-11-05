<?php

declare(strict_types=1);

namespace AutoManager\Handler;

use AutoManager\Form\Manufacturer;
use AutoManager\Storage\Repository\ManufacturerRepository;
use Laminas\Form\FormElementManager;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class NewManufacturerHandlerFactory
{
    public function __invoke(ContainerInterface $container) : NewManufacturerHandler
    {
        $formElementManager = $container->get(FormElementManager::class);
        return new NewManufacturerHandler(
            $formElementManager->get(Manufacturer::class),
            $container->get(ManufacturerRepository::class),
            $container->get(TemplateRendererInterface::class)
        );
    }
}
