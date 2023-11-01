<?php

declare(strict_types=1);

namespace AutoManager;

interface StorageInterface
{
    public function setName(?string $name): self;
    public function getName(): ?string;
}
