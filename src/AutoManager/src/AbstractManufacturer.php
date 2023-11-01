<?php

declare(strict_types=1);

namespace AutoManager;

abstract class AbstractManufacturer implements ManufacturerInterface
{
    private ?int $manufacturerId;
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
