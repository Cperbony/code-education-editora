<?php

namespace CodeEduUser\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface RoleRepository
 * @package namespace CodePub\Repositories;
 */
interface RoleRepository extends RepositoryInterface
{
    public function updatePermission(array $data, $id);
}
