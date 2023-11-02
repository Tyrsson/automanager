<?php

declare(strict_types=1);

namespace AutoManager\Storage\Entity;

use AutoManager\ManufacturerInterface;
use AutoManager\ManufacturerTrait;
use Webinertia\Db\EntityInterface;

final class Manufacturer implements ManufacturerInterface, EntityInterface
{
    use ManufacturerTrait;

    public function getId(): array|int|string|null
    {
        return $this->getManufacturerId();
    }
}
