<?php
namespace Clio\Component\Container\SplImpl;

use Clio\Component\Container\Stack as StackInterface;

/**
 * Stack 
 * 
 * @uses SplStack
 * @uses StackInterface
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class Stack extends SplStack implements StackInterface 
{
    /**
     * __construct 
     * 
     * @param mixed $values 
     * @access public
     * @return void
     */
    public function __construct($values = null)
    {
        if($values instanceof \SplStack) {
            $this->values = $values; 
        } else {
            $this->values = new \SplStack();
        
            if(is_array($values)) {
                foreach($values as $value) {
                    $this->values->push($value); 
                }
            }
        }
    }

    /**
     * push 
     * 
     * @param mixed $value 
     * @access public
     * @return void
     */
    public function push($value)
    {
        return $this->values->push($value);
    }

    /**
     * pop 
     * 
     * @access public
     * @return void
     */
    public function pop()
    {
        return $this->values->pop();
    }

    /**
     * top 
     * 
     * @access public
     * @return void
     */
    public function top()
    {
        return $this->values->top();
    }

    /**
     * bottom 
     * 
     * @access public
     * @return void
     */
    public function bottom()
    {
        return $this->values->bottom();
    }
}

