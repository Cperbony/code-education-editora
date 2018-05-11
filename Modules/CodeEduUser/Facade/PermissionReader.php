<?php

namespace CodeEduUser\Facade;

use Illuminate\Support\Facades\Facade;
use CodeEduUser\Annotations\PermissionReader as PermissionsReaderService;

/**
 * Created by PhpStorm.
 * User: Claus Perbony
 * Date: 21/12/2017
 * Time: 00:19
 */
class PermissionReader extends Facade
{
    protected static function getFacadeAccessor()
    {
        return PermissionsReaderService::class;
    }
}