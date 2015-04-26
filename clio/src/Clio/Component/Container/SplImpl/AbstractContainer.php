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
     * @access private
     */
    private $values;

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
}

