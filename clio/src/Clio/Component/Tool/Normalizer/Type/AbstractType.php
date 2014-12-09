<?php
namespace Clio\Component\Tool\Normalizer\Type;

use Clio\Component\Tool\Normalizer\Type;

abstract class AbstractType implements Type 
{
	private $options = array();
    
    public function getOptions()
    {
        return $this->options;
    }
    
    public function setOptions($options)
    {
        $this->options = $options;
        return $this;
    }

	public function hasOption($name)
	{
		return isset($this->options[$name]);
	}

	public function getOption($name)
	{
		return $this->options[$name];
	}

	public function setOption($name, $value)
	{
		$this->options[$name] = $value;
	}
}

