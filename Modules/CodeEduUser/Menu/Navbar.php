<?php
/**
 * Created by PhpStorm.
 * User: Claus Perbony
 * Date: 31/05/2018
 * Time: 22:03
 */

namespace CodeEduUser\Menu;

class Navbar
{

    /**
     * @param $links
     * @return array
     */
    public function getLinksAuthorized($links)
    {
        $linksAuthorized = [];
        foreach ($links as $link) {
            if (isset($link[0])) { //Menu Dropdown
                $l = $this->getLinksAuthorized($link[1]);
                if (count($l)) {
                    $linksAuthorized[] = [
                        $link[0],
                        $l
                    ];
                }
            } elseif (\Auth::user()->can($link['permission'])) {
                $linksAuthorized[] = $link;
            }
        }
        return $linksAuthorized;
    }
}