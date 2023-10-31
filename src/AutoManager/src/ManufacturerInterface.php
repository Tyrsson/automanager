<?php

declare(strict_types=1);

namespace AutoManager;

use SebastianBergmann\Type\NullType;

interface ManufacturerInterface
{
    public function getId(): int|null;
    public function setName(?string $name): self;
    public function getName(): string|null;
    public function setCountry(?string $country): self;
    public function getCountry(): string|null;
}
