<?php

namespace CodeEduBook\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FindByAuthorCriteria
 * @package namespace CodeEduBook\Criteria;
 */
class FindByBook implements CriteriaInterface
{

    private $bookId;

    public function __construct($bookId)
    {
        $this->bookId = $bookId;
    }

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
            return $model->where('book_id', $this->bookId);
    }
}
