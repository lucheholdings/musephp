<?php
namespace Clio\Component\Container\ArrayImpl;

use Clio\Component\Container\Stack as StackInterface;

/**
 * Stack 
 * 
 * @uses AbstractContainer
 * @uses StackInterface
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class Stack extends AbstractContainer implements StackInterface 
{

    /**
     * push 
     * 
     * @param mixed $value 
     * @access public
     * @return void
     */
    public function push($value)
    {
        array_push($this->values, $value);
    }

    /**
     * pop 
     * 
     * @access public
     * @return void
     */
    public function pop()
    {
        return array_pop($this->values);
    }

    /**
     * top 
     * 
     * @access public
     * @return void
     */
    public function top()
    {
        return end($this->values);
    }

    /**
     * bottom 
     * 
     * @access public
     * @return void
     */
    public function bottom()
    {
        return reset($this->values);
    }

    /**
     * getIterator 
     * 
     * @access public
     * @return void
     */
    public function getIterator()
    {
        return new \ArrayIterator(array_reverse($this->values, true));
    }
}

