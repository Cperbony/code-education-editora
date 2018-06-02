<?php

namespace CodeEduBook\Repositories;

use CodeEduBook\Models\Chapter;
use CodePub\Criteria\CriteriaTrashedTrait;
use CodePub\Repositories\RepositoryRestoreTrait;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeEduBook\Models\Book;

/**
 * Class BookRepositoryEloquent
 * @package namespace CodePub\Repositories;
 */
class ChapterRepositoryEloquent extends BaseRepository implements ChapterRepository
{
    use CriteriaTrashedTrait;
    use RepositoryRestoreTrait;

    protected $fieldSearchable = [
        'title' => 'like',
        'author.name' => 'like',
        'categories.name' => 'like'
    ];

//    public function create(array $attributes)
//    {
//        $model = parent::create($attributes);
//        $model->categories()->sync($attributes['categories']);
//        return $model;
//    }
//
//    public function update(array $attributes, $id)
//    {
//        $model = parent::update($attributes, $id);
//        $model->categories()->sync($attributes['categories']);
//        //return $model;
//    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Chapter::class;
    }

    /**
     * Boot up the repository, pushing criteria
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
