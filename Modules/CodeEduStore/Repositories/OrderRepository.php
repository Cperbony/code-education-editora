<?php

namespace CodeEduStore\Repositories;

use CodeEduStore\Models\ProducStore;
use Prettus\Repository\Contracts\RepositoryCriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CategoryRepository
 * @package namespace CodePub\Repositories;
 */
interface OrderRepository extends
    RepositoryInterface,
    RepositoryCriteriaInterface
{
    /**
     * @param $token
     * @param $user
     * @param ProducStore $productStore
     * @return mixed
     */
    public function process($token, $user, ProducStore $productStore);
}
