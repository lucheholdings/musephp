<?php
namespace Clio\Framework\Accessor\Field\Factory;

use Clio\Component\Util\Accessor\Field\Factory\ClassAccessorFactory;
use Clio\Framework\Accessor\Field\AttributeFieldAccessor;

/**
 * AttributeContainerAccessorFactory
 * 
 * @uses ClassFieldAccessorFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class AttributeContainerAccessorFactory implements ClassAccessorFactory 
{
	/**
	 * attributeClass 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $attributeClass;

	/**
	 * {@inheritdoc}
	 */
	public function createClassAccessor(\ReflectionClass $classReflector, $fieldName, array $options = array())
	{
		if(!$classReflector->implementsInterface('Clio\Component\Util\Attribute\AttributeContainerAware')) {
			throw new \InvalidArgumentException(sprintf('Class "%s" is not implements AttributeContainerAware interface.', $classReflector->getName()));
		}

		if(isset($options['attribute_class'])) {
			$attributeClass = $options['attribute_class'];
		} else {
			$attributeClass = $this->getAttributeClass();
		}
		return new AttributeContainerAccessor(new AttributeAccessor(new AttributeComponentFactory($attributeClass)));
	}
    
    /**
     * getAttributeClass 
     * 
     * @access public
     * @return void
     */
    public function getAttributeClass()
    {
        return $this->attributeClass;
    }
    
    /**
     * setAttributeClass 
     * 
     * @param mixed $attributeClass 
     * @access public
     * @return void
     */
    public function setAttributeClass($attributeClass)
    {
        $this->attributeClass = $attributeClass;
        return $this;
    }
}

