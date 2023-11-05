<?php

declare(strict_types=1);

namespace AutoManager\Form;

use Psr\Container\ContainerInterface;

final class ManufacturerFactory
{
    public function __invoke(ContainerInterface $container): Manufacturer
    {
        return new Manufacturer('manufacturer-form');
    }
}
