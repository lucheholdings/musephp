<?php
namespace Clio\Component\Util\Metadata\SchemaRegistry;

use Clio\Component\Util\Metadata\SchemaRegistry;
use Clio\Component\Pattern\Registry\ProxyRegistry;

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
class ValidateRegistry extends ProxyRegistry implements SchemaRegistry
{
    /**
     * {@inheritdoc}
     */
    public function set($key, $value)
    {
        if(!$value instanceof Schema) {
            throw new \InvalidArgumentException('ValidateRegistry only accept Schema as a value.');
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
            throw new \RuntimeException('Loaded value is invalid. ValidateRegistry only accept Schema as a value.');
        }

        return $value;
    }
}

