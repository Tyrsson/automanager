<?php

declare(strict_types=1);

namespace AutoManager\Storage;

use Laminas\Db\ResultSet\ResultSetInterface;
use Webinertia\Db\EntityInterface;

interface RepositoryInterface
{
    public function findOneById(int $id): EntityInterface;
    public function findOneByColumn(string $column, int|string $value): ResultSetInterface|EntityInterface;
    public function findManyByColumn(array $titles): ResultSetInterface;
    public function fetchAll(): ResultSetInterface|array;
}
