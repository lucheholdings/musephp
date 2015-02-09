<?php
namespace Clio\Extra\Normalizer\Type;

use Clio\Component\Util\Type\Type;
use Clio\Component\Util\Type\Registry as TypeRegistry;

class Registry implements TypeRegistry
{
	private $baseRegistry;

	public function __construct(TypeRegistry $baseRegistry)
	{
		$this->baseRegistry = $baseRegistry;
	}
    
    public function getBaseRegistry()
    {
        return $this->baseRegistry;
    }
    
    public function setBaseRegistry(TypeRegistry $baseRegistry)
    {
        $this->baseRegistry = $baseRegistry;
        return $this;
    }

	public function getType($type)
	{
		$baseType = $this->getBaseRegistry()->getType($type);

		return new NormalizerType($baseType);
	}

	public function guessType($value)
	{
		$baseType = $this->getBaseRegistry()->guessType($value);
		return new NormalizerType($baseType);
	}

	public function hasType($type)
	{
		return $this->getBaseTypeRegistry()->hasType($type);
	}

	public function addType(Type $type)
	{
		if($type instanceof NormalizerType) {
			$type = $type->getType();
		}
		return $this->getBaseTypeRegistry()->addTyep($type);
	}

	public function removeType($type)
	{
		if($type instanceof NormalizerType) {
			$type = $type->getType();
		} 

		return $this->getBaseTypeRegistry()->addTyep($type);
	}
}

