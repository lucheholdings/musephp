<?php
namespace Clio\Component\Accessor\Registry;

use Clio\Component\Accessor\Registry;
use Clio\Component\Accessor\SchemaAccessor;
use Clio\Component\Pattern\Registry\ProxyRegistry;

/**
 * ValidateRegistry 
 * 
 * @uses ProxyRegistry
 * @uses Registry
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ValidateRegistry extends ProxyRegistry implements Registry
{
    /**
     * {@inheritdoc}
     */
    public function set($key, $value)
    {
        if(!$value instanceof SchemaAccessor) {
            throw new \InvalidArgumentException('ValidateRegistry only accept SchemaAccessor as a value.');
        }

        return parent::set($key, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function get($key)
    {
        $value = parent::get($key);

        if(!$value instanceof SchemaAccessor) {
            throw new \RuntimeException('Loaded value is invalid. ValidateRegistry only accept SchemaAccessor as a value.');
        }

        return $value;
    }
}

