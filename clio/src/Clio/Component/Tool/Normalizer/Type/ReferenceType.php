<?php
namespace Clio\Component\Tool\Normalizer\Type;

class ReferenceType implements Type 
{
	private $originalType;

	public function __construct(ObjectType $type)
	{
		$this->originalType = $type;
	}

	public function getName()
	{
		return $this->getOriginalType()->getName();
	}

	public function __toString()
	{
		return $this->getName();
	}

	public function getIdentifierFields()
	{
		return $this->getOriginalType()->getIdentifierFields();
	}

	public function getIdentifierValues($data)
	{
		return $this->getOriginalType()->getIdentifierValues($data);
	}

    
    public function getOriginalType()
    {
        return $this->originalType;
    }
    
    public function setOriginalType($originalType)
    {
        $this->originalType = $originalType;
        return $this;
    }
}

