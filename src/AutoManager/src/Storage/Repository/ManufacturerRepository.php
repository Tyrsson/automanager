<?php

/**
 * In this class we can override method from the RepositoryTrait that provides
 * query access via the $tablegateway property, the property is declared via constructor promotion
 * in the AbstractRepository __construct method
 * I use a Trai here to allow the repo's to be constructed using composition instead of just inheritance
 * since all repo's will share certain methods but may need to override them
 */

declare(strict_types=1);

namespace AutoManager\Storage\Repository;

use AutoManager\Storage\AbstractRepository;

final class ManufacturerRepository extends AbstractRepository
{

}
