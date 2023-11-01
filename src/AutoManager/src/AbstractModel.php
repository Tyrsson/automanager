<?php

declare(strict_types=1);

namespace AutoManager;

abstract class AbstractModel implements ModelInterface
{
    private ?int $manufacturerId;
    private ?int $modelId;
    private ?string $name;

    final protected function setModelId(?int $modelId): ModelInterface
    {
        $this->modelId = $modelId;
        return $this;
    }

    public function getModelId(): ?int
    {
        return $this->modelId;
    }

    public function setManufacturerId(?int $manufacturerId): ModelInterface
    {
        $this->manufacturerId = $manufacturerId;
        return $this;
    }

    public function getManufacturerId(): ?int
    {
        return $this->manufacturerId;
    }

    public function setName(?string $name): StorageInterface
    {
        $this->name = $name;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
}
