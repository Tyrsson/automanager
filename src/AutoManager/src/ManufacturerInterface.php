<?php

declare(strict_types=1);

namespace AutoManager;

interface ManufacturerInterface
{
    public function getManufacturerId(): ?int;
    public function setManufacturerName(?string $manufacturerName): self;
    public function getManufacturerName(): ?string;
    public function setCountry(?string $country): self;
    public function getCountry(): ?string;
}
