<?php

declare(strict_types=1);

namespace AutoManager\Form\Fieldset;

use Psr\Container\ContainerInterface;

final class ManufacturerFieldsetFactory
{
    public function __invoke(ContainerInterface $container): ManufacturerFieldset
    {
        return new ManufacturerFieldset('manufacturer');
    }
}
