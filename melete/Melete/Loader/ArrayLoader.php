<?php
namespace Melete\Loader;

use Symfony\Component\Config\Definition\Processor;
use Melete\Definition;

class ArrayLoader implements Loader
{
	private $definition;

	private $processor;

	public function load($content)
	{
		if(!is_array($content)) {
			throw new \InvalidArgumentException('Content must be an array.');
		}

		if($this->definition) {
			$content = $this->getProcessor()->process(
				$this->definition->getConfigTree()->buildTree(),
				array($content)
			);
		} 

		return $content;
	}
    
    public function getDefinition()
    {
        return $this->definition;
    }
    
    public function setDefinition(Definition $definition)
    {
        $this->definition = $definition;
        return $this;
    }

	public function getProcessor()
	{
		if(!$this->processor) {
			$this->processor = new Processor();
		}
		return $this->processor;
	}
}

