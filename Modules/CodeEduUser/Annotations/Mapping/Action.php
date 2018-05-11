<?php

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