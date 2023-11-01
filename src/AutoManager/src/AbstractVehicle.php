<?php

declare(strict_types=1);

namespace AutoManager;

use AutoManager\VehicleInterface;

abstract class AbstractVehicle implements VehicleInterface
{
    private ?int    $manufacturerId;
    private ?int    $modelId;
    private ?string $name;
    private ?int    $vehicleId;
    private ?string $vin;
    private ?int    $year;

    final protected function setVehicleId(?int $vehicleId): VehicleInterface
    {
        $this->vehicleId = $vehicleId;
        return $this;
    }
    public function getVehicleId(): ?int
    {
        return $this->vehicleId;
    }

    public function setYear(int $year): VehicleInterface
    {
        $this->year = $year;
        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setVin(?string $vin): VehicleInterface
    {
        $this->vin = $vin;
        return $this;
    }

    public function getVin(): ?string
    {
        return $this->vin;
    }

    public function setManufacturerId(?int $manufacturerId): VehicleInterface
    {
        $this->manufacturerId = $manufacturerId;
        return $this;
    }

    public function getManufacturerId(): ?int
    {
        return $this->manufacturerId;
    }

    public function setModelId(?int $modelId): VehicleInterface
    {
        $this->modelId = $modelId;
        return $this;
    }

    public function getModelId(): ?int
    {
        return $this->modelId;
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
