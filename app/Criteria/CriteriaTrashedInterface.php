<?php
/**
 * Created by PhpStorm.
 * User: Claus Perbony
 * Date: 22/10/2017
 * Time: 23:12
 */

namespace CodePub\Criteria;


interface CriteriaTrashedInterface
{
    public function onlyTrashed();
    public function withTrashed();
}