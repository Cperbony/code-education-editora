<?php
/**
 * Created by PhpStorm.
 * User: Claus Perbony
 * Date: 27/11/2017
 * Time: 22:37
 */

namespace CodeEduUser\Annotations\Mapping;

/**
 * Class Action
 * @package CodeEduUser\Annotations\Mapping
 * @Annotation
 * @Target("METHOD")
 */
class Action
{
    public $name;
    public $description;
}