<?php
namespace Clio\Component\Container\SplImpl;

/**
 * AbstractContainer 
 * 
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class AbstractContainer
{
    /**
     * values 
     * 
     * @var mixed
     * @access protected 
     */
    protected $values;

    /**
     * getRaw 
     * 
     * @access public
     * @return void
     */
    public function getRaw()
    {
        return $this->getSplContainer();
    }

    /**
     * getSplContainer 
     * 
     * @access public
     * @return void
     */
    public function getSplContainer()
    {
        return $this->values;
    }

    /**
     * count 
     * 
     * @access public
     * @return void
     */
    public function count()
    {
        return $this->values->count();
    }

    /**
     * getIterator 
     * 
     * @access public
     * @return void
     */
    public function getIterator()
    {
        return $this->values->getIterator();
    }

    /**
     * serialize 
     * 
     * @access public
     * @return void
     */
    public function serialize()
    {
        return serialize($this->values);
    }

    /**
     * unserialize 
     * 
     * @param mixed $serialized 
     * @access public
     * @return void
     */
    public function unserialize($serialized)
    {
        $this->values = unserialize($serialized);
    }
}

