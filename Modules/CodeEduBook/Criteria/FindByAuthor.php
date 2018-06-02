<?php

namespace CodeEduBook\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FindByAuthorCriteria
 * @package namespace CodeEduBook\Criteria;
 */
class FindByAuthor implements CriteriaInterface
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
        if (!\Auth::user()->can(config('codeedubook.acl.permissions.book_manage_all'))) {
            return $model->where('author_id', \Auth::user()->id);
        }
        return $model;
    }
}
