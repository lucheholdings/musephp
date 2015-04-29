<?php
namespace Clio\Component\Container\SplImpl;

use Clio\Component\Container\Queue as QueueInterface;

/**
 * Queue 
 * 
 * @uses QueueInterface
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class Queue implements QueueInterface 
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
        if($values instanceof \SplQueue) {
            $this->values = $values; 
        } else {
            $this->values = new \SplQueue();
        
            if(is_array($values)) {
                foreach($values as $value) {
                    $this->values->enqueue($value); 
                }
            }
        }
    }

    /**
     * enqueue 
     * 
     * @param mixed $value 
     * @access public
     * @return void
     */
    public function enqueue($value)
    {
        $this->values->enqueue($value);
        return $this;
    }

    /**
     * dequeue 
     * 
     * @access public
     * @return void
     */
    public function dequeue()
    {
        return $this->values->dequeue();
    }

    /**
     * begin 
     * 
     * @access public
     * @return void
     */
    public function begin()
    {
        $this->values->rewind();
        return $this->values->current();
    }

    /**
     * end 
     * 
     * @access public
     * @return void
     */
    public function end()
    {
        return $this->values->top();
    }

    /**
     * clear 
     * 
     * @access public
     * @return void
     */
    public function clear()
    {
        $this->values = new \SplQueue();
    }

    /**
     * toArray 
     * 
     * @access public
     * @return void
     */
    public function toArray()
    {
        $values = array();
        foreach($this as $value) {
            $values[] = $value;
        }
        return $values;
    }
}

