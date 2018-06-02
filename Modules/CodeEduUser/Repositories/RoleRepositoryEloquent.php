<?php

namespace CodeEduUser\Repositories;

use CodeEduUser\Models\Role;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class RoleRepositoryEloquent
 * @package namespace CodePub\Repositories;
 */
class RoleRepositoryEloquent extends BaseRepository implements RoleRepository
{
    /**
     * @param array $attributes
     * @param $id
     * @return mixed|void
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(array $attributes, $id)
    {
        $model =  parent::update($attributes, $id);
        if(isset($attributes['permissions'])) {
            $model->permissions()->sync($attributes['permissions']);
        }
        return $model;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Role::class;
    }


    /**
     * Boot up the repository, pushing criteria
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function updatePermissions(array $permissions, $id)
    {
       $role = $this->find($id);
        $role->permissions()->detach();

        if(count($permissions)) {
            $role->permissions()->sync($permissions);
        }
        return $role;
    }
}
