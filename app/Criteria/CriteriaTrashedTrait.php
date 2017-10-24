<?php
/**
 * Created by PhpStorm.
 * User: Claus Perbony
 * Date: 22/10/2017
 * Time: 23:06
 */

namespace CodePub\Criteria;


trait CriteriaTrashedTrait
{

    public function onlyTrashed()
    {
        $this->pushCriteria(FindOnlyTrashedCriteria::class);
        return $this;
    }

    public function withTrashed()
    {
        $this->pushCriteria(FindWithTrashedCriteria::class);
        return $this;
    }
}