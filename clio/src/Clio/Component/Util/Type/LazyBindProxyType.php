<?php
namespace Clio\Component\Util\Type;

/**
 * LazyBindProxyType 
 * 
 * @uses Type
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class LazyBindProxyType implements Type
{
	private $type;

	private $typeRegistry;

	public function __construct($type, Registry $typeRegistry = null)
	{
		$this->type = $type;
		$this->typeRegistry = $typeRegistry;
	}

	public function getName()
	{
		return (string)$this->type;
	}
    
    public function getType()
    {
		if(!$this->type instanceof Type) {
			$this->type = $this->getTypeRegistry()->getTyep($this->type);
		}
        return $this->type;
    }
    
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
    
    public function getTypeRegistry()
    {
		if(!$this->typeRegistry) {
			throw new \RuntimeException('TypeRegistry is not initialized to resolve bound type.');
		}
        return $this->typeRegistry;
    }
    
    public function setTypeRegistry(Registry $typeRegistry)
    {
        $this->typeRegistry = $typeRegistry;
        return $this;
    }

	public function __toString()
	{
		return (string)$this->type;
	}
}

