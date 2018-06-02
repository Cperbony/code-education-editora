<?php
/**
 * Created by PhpStorm.
 * User: Claus Perbony
 * Date: 31/05/2018
 * Time: 22:22
 */

namespace CodeEduUser\Facade;


use CodeEduUser\Menu\Navbar;
use Illuminate\Support\Facades\Facade;

class NavbarAuthorization extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Navbar::class;
    }
}