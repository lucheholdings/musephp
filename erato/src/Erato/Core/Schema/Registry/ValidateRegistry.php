<?php
namespace Erato\Core\Schema\Registry;

use Erato\Core\Schema\Registry;
use Clio\Commponent\Util\Metadata\Schema;

/**
 * ValidateRegistry 
 * 
 * @uses BaseRegistry
 * @uses Registry
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ValidateRegistry extends BaseRegistry implements Registry 
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
     * {@inheritdoc}
     */
    public function set($key, $value)
    {
        if(!$value instanceof Schema) {
            throw new \InvalidArgumentException(sprintf('ValidateRegistry only accept Schema as a value, but "%s" is given for "%s".', is_object($value) ? get_class($value) : gettype($value), $key));
        }

        return parent::set($key, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function get($key)
    {
        $value = parent::get($key);

        if(!$value instanceof Schema) {
            throw new \RuntimeException(sprintf('Loaded value is invalid. ValidateRegistry only accept Schema as a value, but "%s" is given for "%s".', is_object($value) ? get_class($value) : gettype($value), $key));
        }

        return $value;
    }
}

