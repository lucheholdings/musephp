<?php
namespace Clio\Component\Container\Proxy;

use Clio\Component\Container\Container as ContainerInterface;

/**
 * Collection 
 * 
 * @uses AbstractContainer
 * @uses ContainerInteface
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class Collection extends AbstractContainer implements ContainerInteface 
{

    /**
     * {@inheritdoc}
     */
    public function has($value)
    {
        return $this->getWrapped()->has($value);
    }

    /**
     * {@inheritdoc}
     */
    public function hasKey($key)
    {
        return $this->getWrapped()->hasKey($key);
    }

    /**
     * {@inheritdoc}
     */
    public function getKeys()
    {
        return $this->getWrapped()->getKeys();
    }

    /**
     * {@inheritdoc}
     */
    public function getValues()
    {
        return $this->getWrapped()->getValues();
    }

    /**
     * {@inheritdoc}
     */
    public function get($key)
    {
        return $this->getWrapped()->get($key);
    }

    /**
     * {@inheritdoc}
     */
    public function set($key, $value)
    {
        $this->getWrapped()->set($key, $value);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function remove($value)
    {
        return $this->getWrapped()->remove($value);
    }

    /**
     * {@inheritdoc}
     */
    public function removeByKey($key)
    {
        return $this->getWrapped()->removeByKey($key);
    }
}

