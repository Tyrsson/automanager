<?php

declare(strict_types=1);

namespace AutoManager;

interface ModelInterface extends StorageInterface
{
    public function getModelId(): ?int;
    public function setManufacturerId(?int $manufacturerId): self;
    public function getManufacturerId(): ?int;
}
