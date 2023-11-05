<?php

declare(strict_types=1);

namespace AutoManager\Storage;

use Laminas\Hydrator\ReflectionHydrator;
use Webinertia\Db;

class AbstractRepository implements RepositoryInterface
{
    use RepositoryTrait;

    public function __construct(
        protected ReflectionHydrator $hydrator,
        Db\TableGateway $gateway,
    ) {
        $this->hydrator = new ReflectionHydrator();
        $this->gateway = $gateway;
    }
}
