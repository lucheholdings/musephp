<?php
namespace Erato\Core\Schema\Config;

class MappingConfiguration 
{
    public $options = array();

    public function getOptions()
    {
        return $this->options;
    }
    
    public function setOptions($options)
    {
        $this->options = $options;
        return $this;
    }
}

