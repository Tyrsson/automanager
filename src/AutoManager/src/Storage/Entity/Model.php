<?php

declare(strict_types=1);

namespace AutoManager\Storage\Entity;

use AutoManager\ModelInterface;
use AutoManager\ModelTrait;
use Webinertia\Db\EntityInterface;

final class Model implements ModelInterface, EntityInterface
{
    use ModelTrait;

    public function getId(): array|int|string|null
    {
        return $this->getModelId();
    }
}
