<?php
namespace Clio\Component\Container\SplImpl;

use Clio\Component\Container\Queue as QueueInterface;

class Queue implements QueueInterface 
{
    private $values;

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

    public function enqueue($value)
    {
        $this->values->enqueue($value);
        return $this;
    }

    public function dequeue()
    {
        return $this->values->dequeue();
    }

    public function toArray()
    {
        $values = array();
        foreach($this as $value) {
            $values[] = $value;
        }
        return $values;
    }
}

