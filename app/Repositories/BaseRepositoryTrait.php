<?php
/**
 * Created by PhpStorm.
 * User: Claus Perbony
 * Date: 18/10/2017
 * Time: 23:35
 */

namespace CodePub\Repositories;


trait BaseRepositoryTrait
{
    /**
     * Retrieve data array for populate field select
     *
     * @param string $column
     * @param string|null $key
     *
     * @return \Illuminate\Support\Collection|array
     */
    public function lists($column, $key = null)
    {
        $this->applyCriteria();

        return $this->model->pluck($column, $key);
    }

}