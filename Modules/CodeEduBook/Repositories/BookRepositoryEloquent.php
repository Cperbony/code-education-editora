<?php

namespace CodeEduBook\Repositories;

use CodeEduBook\Repositories\BookRepository;
use CodePub\Criteria\CriteriaTrashedTrait;
use CodePub\Repositories\RepositoryRestoreTrait;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeEduBook\Models\Book;
use CodePub\Validators\BookValidator;

/**
 * Class BookRepositoryEloquent
 * @package namespace CodePub\Repositories;
 */
class BookRepositoryEloquent extends BaseRepository implements BookRepository
{
    use CriteriaTrashedTrait;
    use RepositoryRestoreTrait;

    protected $fieldSearchable = [
        'title' => 'like',
        'author.name' => 'like',
        'categories.name' => 'like'
    ];

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        $model = null;
        $create = function () use ($attributes, &$model) {
            $model = parent::create($attributes);
        };
        $create = \Closure::bind($create, $this);
        if (!isset($attributes['published'])) {
            Book::withoutSyncingToSearch($create);
        } else {
            $create();
        }
        $model->categories()->sync($attributes['categories']);

        return $model;
    }

    /**
     * @param array $attributes
     * @param $id
     * @return mixed|void
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(array $attributes, $id)
    {
        $model = parent::update($attributes, $id);
        $model->categories()->sync($attributes['categories']);
        //return $model;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Book::class;
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
