<?php

namespace CodePub\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodePub\Repositories\CategoryRepository;
use CodePub\Models\Category;
use CodePub\Validators\CategoryValidator;

/**
 * Class CategoryRepositoryEloquent
 * @package namespace CodePub\Repositories;
 */
class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{
    use BaseRepositoryTrait;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
