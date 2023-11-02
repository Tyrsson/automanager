<?php

declare(strict_types=1);

namespace AutoManager;

interface ModelInterface
{
    public function getModelId(): ?int;
    public function setManufacturerId(?int $manufacturerId): self;
    public function getManufacturerId(): ?int;
    public function setYear(int $year): self;
    public function getYear(): ?int;
    public function setModelName(?string $modelName): self;
    public function getModelName(): ?string;
}
