<?php

namespace CodePub\Repositories;

use CodePub\Criteria\CriteriaTrashedInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CategoryRepository
 * @package namespace CodePub\Repositories;
 */
interface CategoryRepository extends
    RepositoryInterface,
    CriteriaTrashedInterface
{
    public function listsWithMutators($column, $key = null);
}
