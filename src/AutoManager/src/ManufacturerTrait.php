<?php

declare(strict_types=1);

namespace AutoManager;

trait ManufacturerTrait
{
    private ?int $manufacturerId;
    private ?string $manufacturerName;
    private ?string $country;
    private ?string $name;

    final protected function setManufacturerId(int $manufacturerId): ManufacturerInterface
    {
        $this->manufacturerId = $manufacturerId;
        return $this;
    }

    public function getManufacturerId(): ?int
    {
        return $this->manufacturerId;
    }

    public function setManufacturerName(?string $manufacturerName): ManufacturerInterface
    {
        $this->manufacturerName = $manufacturerName;
        return $this;
    }

    public function getManufacturerName(): ?string
    {
        return $this->manufacturerName;
    }

    public function setCountry(?string $country): ManufacturerInterface
    {
        $this->country = $country;
        return $this; // we can return $this since this class implements ManufacturerInterface
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setName(?string $name): StorageInterface
    {
        $this->name = $name;
        return $this; // we can return $this since this class implements StorageInterface, since its Inherited by ManufacturerInterface
    }
    public function getName(): ?string
    {
        return $this->name;
    }
}
