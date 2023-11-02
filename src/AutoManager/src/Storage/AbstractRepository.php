<?php

declare(strict_types=1);

namespace AutoManager\Storage;

use Laminas\Hydrator\ReflectionHydrator;
use Webinertia\Db;

class AbstractRepository implements RepositoryInterface
{
    use RepositoryTrait;

    public function __construct(
        private ReflectionHydrator $hydrator = new ReflectionHydrator(),
        Db\TableGateway $gateway,
    ) {
        $this->gateway = $gateway;
    }
}
