<?php
namespace Clio\Component\Util\Metadata\Schema;

use Clio\Component\Util\Metadata\InheritableMetadata;
use Clio\Component\Util\Metadata\Mapping\MappingCollection;

/**
 * ClassMetadata 
 * 
 * @uses AbstractSchemaMetadata
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ClassMetadata extends AbstractSchemaMetadata implements InheritableMetadata 
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
	public function __construct(\ReflectionClass $reflectionClass, array $fields = array())
	{
		$this->reflectionClass = $reflectionClass;

		parent::__construct($fields);
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
				$this->parent = $this->getRegistry()->get($this->getReflectionClass()->getParentClass());
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

	public function serialize()
	{
		return serialize(array(
			$this->reflectionClass->getName(),
			$this->getFields(),
			$this->getMappings()->toArray()
		));
	}

	public function unserialize($serialized)
	{
		$data = unserialize($serialized);
		if(!$data) {
			throw new \RuntimeException(sprintf('Failed to unserialize "%s"', __CLASS__));
		}
		list(
			$class,
			$fields,
			$mappings
		) = $data;

		$this->reflectionClass = new \ReflectionClass($class);
		$this->setFields($fields);
		$this->setMappings(new MappingCollection($mappings));
	}
}

