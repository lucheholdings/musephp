<?php
namespace Calliope\Core\Schema\Registry;

use Calliope\Core\Schema\Registry;
use Clio\Component\Pattern\Registry\ProxyRegistry;

use Calliope\Core\Schema;

/**
 * ValidateRegistry 
 * 
 * @uses ProxyRegistry
 * @uses SchemaRegistry
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ValidateRegistry extends ProxyRegistry implements Registry
{
    /**
     * has 
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
    public function has($key)
    {
        return parent::has($key);
    }

    /**
     * set 
     * 
     * @param mixed $key 
     * @param mixed $value 
     * @access public
     * @return void
     */
    public function set($key, $value)
    {
        if(!$value instanceof Schema) {
            throw new \RuntimeException(sprintf('Registered Schema "%s" is not an instanceof Calliope\Core\Schema', $key));
        }

        parent::set($key, $value);
    }

    /**
     * get 
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
    public function get($key)
    {
        $value = parent::get($key);

        if(!$value instanceof Schema) {
            throw new \RuntimeException(sprintf('Registered Schema "%s" is not an instanceof Calliope\Core\Schema', $key));
        }

        return $value;
    }
}

