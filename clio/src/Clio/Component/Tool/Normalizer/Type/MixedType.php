<?php
namespace Clio\Component\Tool\Normalizer\Type;

use Clio\Component\Tool\Normalizer\Context;

class MixedType extends AbstractType  
{
	protected $actualType;

	public function getName()
	{
		return ($this->actualType) ? $this->getActualType()->getName() : 'mixed';
	}

	public function __toString()
	{
		return $this->getName();
	}

	public function resolve(Context $context, $data)
	{
		$this->actualType = $context->getTypeRegistry()->resolveMixed($this, $data);
	}
    
    public function getActualType()
    {
		if(!$this->actualType)
			throw new \RuntimeException('Type mixed is not resolved yet.');
        return $this->actualType;
    }
    
    public function setActualType($actualType)
    {
        $this->actualType = $actualType;
        return $this;
    }

	public function getFieldType($field, Context $context)
	{
		return $this->getActualType()->getFieldType($field, $context);
	}

	public function getIdentifierFields()
	{
		return $this->getActualType()->getIdentifierFields();
	}

	public function getIdentifierValues($data)
	{
		return $this->getActualType()->getIdentifierValues($data);
	}

	public function getClassReflector()
	{
		return $this->getActualType()->getClassReflector();
	}

	public function canReference()
	{
		return $this->getActualType()->canReference();
	}

	public function reference()
	{
		return $this->getActualType()->reference();
	}
}

