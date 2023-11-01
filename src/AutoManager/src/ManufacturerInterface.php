<?php

declare(strict_types=1);

namespace AutoManager;

interface ManufacturerInterface extends StorageInterface
{
    public function getManufacturerId(): ?int;
    public function setCountry(?string $country): self;
    public function getCountry(): ?string;
}
