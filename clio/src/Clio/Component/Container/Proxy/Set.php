<?php
namespace Clio\Component\Container\Proxy;

use Clio\Component\Container\Set as SetInterface;

/**
 * Set 
 * 
 * @uses AbstractContainer
 * @uses SetInterface
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class Set extends AbstractContainer implements SetInterface 
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
    public function getValues()
    {
        return $this->getWrapped()->getValues();
    }

    /**
     * {@inheritdoc}
     */
    public function add($value)
    {
        $this->getWrapped()->add($value);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function remove($value)
    {
        return $this->getWrapped()->remove($value);
    }
}

