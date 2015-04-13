<?php
namespace Clio\Component\Util\Type\Registry;

use Clio\Component\Pattern\Registry\ProxyRegistry;
use Clio\Component\Util\Type\Registry as TypeRegistry;
use Clio\Component\Util\Type\Type;

/**
 * ValidateRegistry 
 * 
 * @uses ProxyRegistry
 * @uses TypeRegistry
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ValidateRegistry extends ProxyRegistry implements TypeRegistry
{
    /**
     * {@inheritdoc}
     */
    public function set($key, $value)
    {
        if(!$value instanceof Type) {
            throw new \InvalidArgumentException('ValidateRegistry only accept Type as a value.');
        }

        return parent::set($key, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function get($key)
    {
        $value = parent::get($key);

        if(!$value instanceof Type) {
            throw new \RuntimeException('Loaded value is invalid. ValidateRegistry only accept Type as a value.');
        }

        return $value;
    }

    public function getType($type)
    {
        return $this->get($type);
    }

    public function hasType($type)
    {
        return $this->has($type);
    }

    public function addType(Type $type)
    {
        return $this->set($type->getName(), $type);
    }

    public function removeType($type)
    {
        $this->remove($type);
    }
}

