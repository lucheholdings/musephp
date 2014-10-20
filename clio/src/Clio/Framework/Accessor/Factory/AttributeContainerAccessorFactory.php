<?php
namespace Clio\Framework\Accessor\Factory;

use Clio\Component\Util\Accessor\Factory\AbstractClassAccessorFactory;
use Clio\Framework\Accessor\AttributeContainerAccessor;
use Clio\Component\Util\Attribute\AttributeAccessor,
	Clio\Component\Util\Attribute\AttributeComponentFactory
;

/**
 * AttributeContainerAccessorFactory
 * 
 * @uses ClassFieldAccessorFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class AttributeContainerAccessorFactory extends AbstractClassAccessorFactory
{
	/**
	 * attributeFactory 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $attributeFactory;

	/**
	 * {@inheritdoc}
	 */
	public function createClassAccessor(\ReflectionClass $classReflector, $fieldName, array $options = array())
	{
		if(!$classReflector->implementsInterface('Clio\Component\Util\Attribute\AttributeContainerAware')) {
			throw new \InvalidArgumentException(sprintf('Class "%s" is not implements AttributeContainerAware interface.', $classReflector->getName()));
		}


		// If attributeFactory is not initialize, then craete with attributeClass
		if(!$this->attributeFactory) {
			$attributeClass = null;
			if(isset($options['attribute_class'])) {
				$attributeClass = $options['attribute_class'];
			}
			$this->attributeFactory = new AttributeComponentFactory($attributeClass);
		}
		return new AttributeContainerAccessor($this->createAttributeAccessor($this->getAttributeFactory()));
	}

	/**
	 * createAttributeAccessor 
	 * 
	 * @param mixed $factory 
	 * @access protected
	 * @return void
	 */
	protected function createAttributeAccessor($factory)
	{
		return new AttributeAccessor($factory);
	}

	/**
	 * isSupportedClassSchema 
	 * 
	 * @param mixed $schema 
	 * @access public
	 * @return void
	 */
	public function isSupportedClassSchema($schema)
	{
		return $schema->implementsInterface('Clio\Component\Util\Attribute\AttributeContainerAware');
	}
    
    /**
     * getAttributeFactory 
     * 
     * @access public
     * @return void
     */
    public function getAttributeFactory()
    {
        return $this->attributeFactory;
    }
    
    /**
     * setAttributeFactory 
     * 
     * @param mixed $attributeFactory 
     * @access public
     * @return void
     */
    public function setAttributeFactory($attributeFactory)
    {
        $this->attributeFactory = $attributeFactory;
        return $this;
    }
}

