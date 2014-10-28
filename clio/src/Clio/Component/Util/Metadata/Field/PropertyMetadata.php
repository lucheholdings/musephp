<?php
namespace Clio\Component\Util\Metadata\Field;

use Clio\Component\Util\Metadata\Mapping\MappingCollection;
/**
 * PropertyMetadata 
 * 
 * @uses AbstractFieldMetadata
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class PropertyMetadata extends AbstractFieldMetadata 
{
	/**
	 * {@inheritdoc}
	 */
	private $reflectionProperty;

	/**
	 * {@inheritdoc}
	 */
	public function __construct(\ReflectionProperty $reflectionProperty)
	{
		$this->reflectionProperty = $reflectionProperty;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		return $this->getReflectionProperty()->getName();
	}
    
    /**
     * getReflectionProperty 
     * 
     * @access public
     * @return void
     */
    public function getReflectionProperty()
    {
        return $this->reflectionProperty;
    }

	/**
	 * {@inheritdoc}
	 */
	public function getType()
	{
		return 'property';
	}

	public function serialize()
	{
		return serialize(array(
			$this->getReflectionProperty()->getDeclaringClass()->getName(),
			$this->getReflectionProperty()->getName(),
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
			$name,
			$mappings
		) = $data;

		$class = new \ReflectionClass($class);
		$this->reflectionProperty = $class->getProperty($name);
		$this->setMappings(new MappingCollection($mappings));
	}
}

