<?php
namespace Clio\Component\Tool\Normalizer\Type;

use Clio\Component\Tool\Normalizer\Type;
use Clio\Component\Tool\Normalizer\Context;

/**
 * ReferenceType 
 * 
 * @uses Type
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ReferenceType implements Type, ObjectType 
{
	/**
	 * originalType 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $originalType;

	/**
	 * __construct 
	 * 
	 * @param ObjectType $type 
	 * @access public
	 * @return void
	 */
	public function __construct(ObjectType $type)
	{
		$this->originalType = $type;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		return $this->getOriginalType()->getName();
	}

	/**
	 * {@inheritdoc}
	 */
	public function __toString()
	{
		return $this->getName();
	}

	/**
	 * {@inheritdoc}
	 */
	public function getFieldType($field, Context $context)
	{
		return $this->getOriginalType()->getFieldType($field, $context);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getIdentifierFields()
	{
		return $this->getOriginalType()->getIdentifierFields();
	}

	/**
	 * {@inheritdoc}
	 */
	public function getIdentifierValues($data)
	{
		return $this->getOriginalType()->getIdentifierValues($data);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getClassReflector()
	{
		return $this->getOriginalType()->getClassReflector();
	}
    
    /**
     * getOriginalType 
     * 
     * @access public
     * @return void
     */
    public function getOriginalType()
    {
        return $this->originalType;
    }
    
    /**
     * setOriginalType 
     * 
     * @param mixed $originalType 
     * @access public
     * @return void
     */
    public function setOriginalType($originalType)
    {
        $this->originalType = $originalType;
        return $this;
    }

	public function construct()
	{
		return $this->getOriginalType()->construct();
	}

	public function getDataPool()
	{
		return $this->getOriginalType()->getDataPool();
	}
}

