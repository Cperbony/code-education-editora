<?php
/**
 * Created by PhpStorm.
 * User: Claus Perbony
 * Date: 22/10/2017
 * Time: 23:06
 */

namespace CodePub\Criteria;


use CodeEduUser\Criteria\FindPermissionsResourceCriteria;

trait CriteriaTrashedTrait
{

    /**
     * @return $this
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function onlyTrashed()
    {
        $this->pushCriteria(FindOnlyTrashedCriteria::class);
        return $this;
    }

    /**
     * @return $this
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function withTrashed()
    {
        $this->pushCriteria(FindPermissionsResourceCriteria::class);
        return $this;
    }
}