<?php

declare(strict_types=1);

namespace AutoManager;

use AutoManager\ManufacturerInterface;
use AutoManager\ModelInterface;

interface VehicleInterface extends StorageInterface
{
    public function getVehicleId(): ?int;
    public function setYear(int $year): self;
    public function getYear(): ?int;
    public function setVin(?string $vin): self;
    public function getVin(): ?string;
    public function setManufacturerId(?int $manufacturerId): self;
    public function getManufacturerId(): ?int;
    public function setModelId(?int $modelId): self;
    public function getModelId(): ?int;
}
