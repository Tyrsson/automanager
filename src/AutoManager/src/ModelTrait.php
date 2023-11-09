<?php

declare(strict_types=1);

namespace AutoManager;

trait ModelTrait
{
    // These must have default values set to be hydrated
    private ?int $manufacturerId = null;
    private ?int $modelId        = null;
    private ?string $modelName   = null;
    private ?int $year           = null;

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

    public function setModelName(?string $modelName): ModelInterface
    {
        $this->modelName = $modelName;
        return $this;
    }

    public function getModelName(): ?string
    {
        return $this->modelName;
    }
    public function setYear(int $year): self
    {
        $this->year = $year;
        return $this;
    }
    public function getYear(): ?int
    {
        return $this->year;
    }
}
