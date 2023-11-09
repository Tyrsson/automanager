<?php

declare(strict_types=1);

namespace AutoManager\Storage\Repository;

use AutoManager\Storage\AbstractRepository;
use Laminas\Db\Exception;
use Webinertia\Db\EntityInterface;

final class VehicleRepository extends AbstractRepository
{
    public function save(EntityInterface $entity): EntityInterface|int
    {
        $set = $this->hydrator->extract($entity);
        if ($set === []) {
            throw new Exception\InvalidArgumentException('Repository can not save empty entity.');
        }
        try {
            if (! isset($set['manufacturerId']) ) {
                // insert
                $this->gateway->insert($set);
                $set['manufacturerId'] = $this->gateway->getLastInsertValue();
            }
            $this->gateway->update($set, ['manufacturerId' => $set['manufacturerId']]);
        } catch (\Throwable $th) {
            // todo: add logging, throw exception
        }
        return $this->hydrator->hydrate($set, $entity);
    }
}
