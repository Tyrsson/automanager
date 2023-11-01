<?php

declare(strict_types=1);

namespace AutoManager\Storage;

use Laminas\Db\ResultSet\ResultSetInterface;
use Laminas\Db\TableGateway\AbstractTableGateway;
use Laminas\Db\TableGateway\TableGatewayInterface;
use Webinertia\Db\EntityInterface;

trait RepositoryTrait
{
    // Both of these are not required to be present $|$ but it allows vscode to read and not see the methods as undefined
    private TableGatewayInterface|AbstractTableGateway $gateway;

    public function save(EntityInterface $entity): EntityInterface|int
    {
        $set = $this->hydrator->extract($entity);
        if ($set === []) {
            throw new \InvalidArgumentException('Repository can not save empty entity.');
        }
        try {
            if (! isset($set['id']) ) {
                // insert
                $this->gateway->insert($set);
                $set['id'] = $this->gateway->getLastInsertValue();
            }
            $this->gateway->update($set, ['id' => $set['id']]);
        } catch (\Throwable $th) {
            // todo: add logging, throw exception
        }
        return $this->hydrator->hydrate($set, $entity);
    }

    public function fetchAll($fetchArray = false): ResultSetInterface|array
    {
        if ($fetchArray) {
            return $this->gateway->select()->toArray();
        }
        return $this->gateway->select();
    }

    public function findOneById(int $id): EntityInterface { }

    public function findOneByColumn(string $column, int|string $value): ResultSetInterface|EntityInterface { }

    public function findManyByColumn(array $titles): ResultSetInterface { }

    //public function fetchAll(): ResultSetInterface { }

    public function delete(EntityInterface $entity): int { }
}
