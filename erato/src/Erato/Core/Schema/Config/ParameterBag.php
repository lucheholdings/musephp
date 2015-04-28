<?php
namespace Erato\Core\Schema\Config;

use Clio\Component\Util\Container\Map\SimpleMap;

/**
 * ParameterBag 
 * 
 * @uses SimpleMap
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ParameterBag extends SimpleMap
{
    /**
     * get 
     * 
     * @param mixed $key 
     * @param mixed $default 
     * @access public
     * @return void
     */
    public function get($key, $default = null)
    {
        if(parent::has($key)) {
            return parent::get($key);
        }
        return $default;
    }
}
