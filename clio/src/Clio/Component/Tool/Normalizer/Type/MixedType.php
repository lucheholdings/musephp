<?php
namespace Clio\Component\Tool\Normalizer\Type;

use Clio\Component\Tool\Normalizer\Type;
use Clio\Component\Tool\Normalizer\Context;

/**
 * MixedType 
 * 
 * @uses AbstractType
 * @uses 
 * @uses ReferencableType
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class MixedType extends AbstractType implements Type, ObjectType
{
	/**
	 * {@inheritdoc}
	 */
	protected $actualType;

	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		return ($this->actualType) ? $this->getActualType()->getName() : self::TYPE_MIXED;
	}

	/**
	 * {@inheritdoc}
	 */
	public function resolve(Context $context, $data)
	{
		$this->actualType = $context->getTypeRegistry()->resolveMixed($this, $data);
	}
    
    /**
     * {@inheritdoc}
     */
    public function getActualType()
    {
		if(!$this->actualType)
			throw new \RuntimeException('Please resolve MixedType with context and data, first');

        return $this->actualType;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setActualType(Type $actualType)
    {
        $this->actualType = $actualType;
        return $this;
    }

	/**
	 * {@inheritdoc}
	 */
	public function getFieldType($field, Context $context)
	{
		return $this->getActualType()->getFieldType($field, $context);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getIdentifierFields()
	{
		return $this->getActualType()->getIdentifierFields();
	}

	/**
	 * {@inheritdoc}
	 */
	public function getIdentifierValues($data)
	{
		return $this->getActualType()->getIdentifierValues($data);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getClassReflector()
	{
		return $this->getActualType()->getClassReflector();
	}

	/**
	 * {@inheritdoc}
	 */
	public function canReference()
	{
		return $this->getActualType()->canReference();
	}

	public function construct()
	{
		return $this->getActualType()->construct();
	}

	public function getDataPool()
	{
		return $this->getActualType()->getDataPool();
	}

	/**
	 * {@inheritdoc}
	 */
	public function reference()
	{
		return $this->getActualType()->reference();
	}
}

