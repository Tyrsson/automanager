<?php

declare(strict_types=1);

namespace AutoManager\Storage;

use Closure;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Exception\RuntimeException;
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\ResultSet\ResultSetInterface;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Where;
use Laminas\Db\TableGateway\AbstractTableGateway;
use Laminas\Db\TableGateway\Exception\InvalidArgumentException;
use Laminas\Db\TableGateway\Exception\RuntimeException as TableGatewayRuntimeException;
use Laminas\Db\TableGateway\TableGatewayInterface;
use Laminas\Stdlib\ArrayUtils;
use Webinertia\Db\EntityInterface;

trait RepositoryTrait
{
    // Both of these are not required to be present $|$ but it allows vscode to read and not see the methods as undefined
    protected TableGatewayInterface|AbstractTableGateway $gateway;

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

    public function findAll($fetchArray = false): ResultSetInterface|array
    {
        if ($fetchArray) {
            return $this->gateway->select()->toArray();
        }
        return $this->gateway->select();
    }

    public function findOneById(int $id): EntityInterface { }

    public function findOneByColumn(string $column, int|string $value): ResultSetInterface|EntityInterface
    {
        $column = (string) $column;
        $where = new Where();
        if (! is_array($value)) {
            $where->equalTo($column, $value);
        } else {
            $where->in($column, $value);
        }
        /** @var HydratingResultSet|ResultSet $resultSet */
        $resultSet = $this->gateway->select($where);
        return $resultSet->current();
    }

    public function findManyByColumn(array $titles): ResultSetInterface { }

    public function recordExists(array $data): bool
    {
        if (ArrayUtils::hasNumericKeys($data) || $data === []) {
            throw new InvalidArgumentException('$data must be a non empty associative array with only string keys');
        }
        $where  = new Where();
        foreach ($data as $column => $value) {
            $where->equalTo($column, $value);
        }
        $check = $this->gateway->select($where);
        $result = $check->current();
        if($result) {
            return true;
        } else {
            return false;
        }
    }

    public function noRecordExists(array $data): bool
    {
        if (ArrayUtils::hasNumericKeys($data) || $data === []) {
            throw new InvalidArgumentException('$data must be a non empty associative array with only string keys');
        }
        $where  = new Where();
        foreach ($data as $column => $value) {
            $where->equalTo($column, $value);
        }
        $check = $this->gateway->select($where);
        $result = $check->current();
        if($result) {
            return false;
        } else {
            return true;
        }
    }

    public function getLastInsertId(): int|string
    {
        return $this->gateway->getLastInsertValue();
    }

    public function delete(Where|Closure|array $where): int
    {
        return $this->gateway->delete($where);
    }

    public function getResourceId(): string
    {
        return $this->resourceId ?? static::class;
    }

    public function getOwnerId(): int|string
    {
        return $this->ownerId ?? $this->offsetGet('ownerId') ?? $this->offsetGet('userId');
    }

    public function getAdapter(): AdapterInterface
    {
        return $this->gateway->getAdapter();
    }

    public function toArray()
    {
        return $this->getArrayCopy();
    }

    public function getTable(): string
    {
        return $this->gateway->getTable();
    }

    public function getGateway(): TableGatewayInterface
    {
        return $this->gateway;
    }
}
