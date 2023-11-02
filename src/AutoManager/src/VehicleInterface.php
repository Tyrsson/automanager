<?php

declare(strict_types=1);

namespace AutoManager;

interface VehicleInterface extends StorageInterface, ManufacturerInterface, ModelInterface
{
    public function getVehicleId(): ?int;
    public function setVin(?string $vin): self;
    public function getVin(): ?string;
    public function setManufacturerId(?int $manufacturerId): self;
    public function getManufacturerId(): ?int;
    public function setModelId(?int $modelId): self;
    public function getModelId(): ?int;
}
