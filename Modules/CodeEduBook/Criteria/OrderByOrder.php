<?php
/**
 * Created by PhpStorm.
 * User: Claus Perbony
 * Date: 01/06/2018
 * Time: 22:18
 */

namespace CodeEduBook\Criteria;


use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class OrderByOrder
 * @package namespace CodeEduBook\Criteria
 */
class OrderByOrder implements CriteriaInterface
{


    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->orderBy('order', 'asc');
    }
}