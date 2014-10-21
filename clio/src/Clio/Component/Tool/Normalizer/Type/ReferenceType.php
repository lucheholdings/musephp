<?php
namespace Clio\Component\Tool\Normalizer\Type;

use Clio\Component\Tool\Normalizer\Type;

/**
 * ReferenceType 
 * 
 * @uses Type
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
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

	public function getFieldType($field)
	{
		return $this->getOriginalType()->getFieldType($field);
	}

	public function getIdentifierFields()
	{
		return $this->getOriginalType()->getIdentifierFields();
	}

	public function getIdentifierValues($data)
	{
		return $this->getOriginalType()->getIdentifierValues($data);
	}

	public function getClassReflector()
	{
		return $this->getOriginalType()->getClassReflector();
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

