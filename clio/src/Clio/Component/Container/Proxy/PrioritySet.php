<?php
namespace Clio\Component\Container\Proxy;

use Clio\Component\Container\Container;
use Clio\Component\Container\PrioritySet as PrioritySetInterface;

/**
 * PrioritySet 
 * 
 * @uses AbstractContainer
 * @uses SetInterface
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class PrioritySet extends Set implements PrioritySetInterface 
{
    /**
     * {@inheritdoc}
     */
    public function add($value, $priority = 0)
    {
        $this->getWrapped()->add($value, $priority);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setWrapped(Container $wrapped)
    {
        if(!$wrapped instanceof PrioritySetInterface) {
            throw new \InvalidArgumentException('PrioritySet only accept PrioirtySet as wrapped container.');
        }
        parent::setWrapped($wrapped);
    }
}

