<?php

namespace CodeEduUser\Annotations\Mapping;

/**
 * Class Controller
 * @package CodeEduUser\Annotations\Mapping
 * @Annotation
 * @Target("CLASS")
 */
class Controller
{
    public $name;
    public $description;
}