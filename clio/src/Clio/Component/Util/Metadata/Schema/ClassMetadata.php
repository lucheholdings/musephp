<?php
namespace Clio\Component\Util\Metadata\Schema;

use Clio\Component\Util\Metadata\SchemaMetadata;
use Clio\Component\Util\Metadata\InheritedMetadata;
use Clio\Component\Util\Metadata\Mapping\Collection as MappingCollection;

/**
 * ClassMetadata 
 * 
 * @uses AbstractSchemaMetadata
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ClassMetadata extends AbstractSchemaMetadata implements InheritedMetadata 
{
	/**
	 * reflectionClass 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $reflectionClass;

	/**
	 * parent 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $parent;

	/**
	 * __construct 
	 * 
	 * @param \ReflectionClass $reflectionClass 
	 * @access public
	 * @return void
	 */
	public function __construct(\ReflectionClass $reflectionClass, array $fields = array(), ClassMetadata $parent = null)
	{
		$this->reflectionClass = $reflectionClass;
		$this->parent = $parent;

		parent::__construct($fields);
	}

	public function newInstance()
	{
		return $this->newInstanceArgs(func_get_args());
	}

	public function newInstanceArgs(array $args)
	{
		if($this->hasMapping('constructor')) {
			return $this->getMapping('constructor')->construct($this->getReflectionClass(), $args);
		} else {
			return $this->getReflectionClass()->newInstanceArgs($args);
		}
	}

	public function getFields($includeInherit = true)
	{
		if($includeInherit && $this->hasParent())
			return array_merge($this->getParent()->getFields(), parent::getFields());
		else
			return parent::getFields();
	}
    
    /**
     * {@inheritdoc}
     */
    public function getReflectionClass()
    {
        return $this->reflectionClass;
    }

	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		return $this->getReflectionClass()->getName();
	}

    /**
     * getParent 
     * 
     * @access public
     * @return void
     */
    public function getParent()
    {
		if(null === $this->parent) {
			if($this->getReflectionClass()->getParentClass()) {
				// Load parent Metadata
				throw new \RuntimeException('Metadata is not initialized yet. Please set parent Metadata for inherited.');
			} else {
				$this->parent = false;
			}
		}
        return $this->parent;
    }
    
    /**
     * setParent 
     * 
     * @param mixed $parent 
     * @access public
     * @return void
     */
    public function setParent(SchemaMetadata $parent)
    {
        $this->parent = $parent;
        return $this;
    }

	public function hasParent()
	{
		return (bool)$this->getReflectionClass()->getParentClass();
	}

	public function getParentName()
	{
		return $this->getReflectionClass()->getParentClass()->getName();
	}

	public function isInherited($name)
	{
		if(class_exists($name) || interface_exists($name)) {
			return ($name == $this->getReflectionClass()->getName())
				|| $this->getReflectionClass()->isSubclassOf($name)
			;
		}
		return false;
	}
	
	public function serialize(array $extra = array())
	{
		$extra['name'] = $this->reflectionClass->getName();

		return parent::serialize($extra);
	}

	public function unserialize($serialized)
	{
		$extra = parent::unserialize($serialized);

		$this->reflectionClass = new \ReflectionClass($extra['name']);
		$this->parent = null;

		return $extra;
	}

	/**
	 * {@inheritdoc}
	 */
	public function isSchemaData($data)
	{
		return $this->getReflectionClass()->isInstance($data);
	}
}

