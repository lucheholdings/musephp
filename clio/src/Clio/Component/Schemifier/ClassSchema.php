<?php
namespace Clio\Component\Schemifier;

/**
 * ClassSchema 
 * 
 * @uses Schema
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ClassSchema implements Schema 
{
	/**
	 * classReflector 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $classReflector;

	/**
	 * __construct 
	 * 
	 * @param \ReflectionClass $class 
	 * @access public
	 * @return void
	 */
	public function __construct(\ReflectionClass $classReflector)
	{
		$this->classReflector = $classReflector;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		return $this->getClassReflector()->getName();
	}

	/**
	 * {@inheritdoc}
	 */
	public function isValidData($data)
	{
		return is_object($data) && $this->getClassReflector()->isInstance($data);
	}

	/**
	 * {@inheritdoc}
	 */
	public function isSchemaType($type)
	{
		return self::SCHEMA_TYPE_CLASS === $type; 
	}
    
    /**
     * getClassReflector 
     * 
     * @access public
     * @return void
     */
    public function getClassReflector()
    {
        return $this->classReflector;
    }
    
    /**
     * setClassReflector 
     * 
     * @param mixed $classReflector 
     * @access public
     * @return void
     */
    public function setClassReflector($classReflector)
    {
        $this->classReflector = $classReflector;
        return $this;
    }

	public function __toString()
	{
		return $this->getName();
	}
}

