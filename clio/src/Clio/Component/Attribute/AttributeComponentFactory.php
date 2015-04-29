<?php
namespace Clio\Component\Attribute;

use Clio\Component\Pattern\Factory\ComponentFactory;

/**
 * AttributeComponentFactory 
 * 
 * @uses ComponentFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class AttributeComponentFactory extends ComponentFactory implements AttributeFactory 
{
	/**
	 * __construct 
	 * 
	 * @param mixed $attributeClass 
	 * @access public
	 * @return void
	 */
	public function __construct($attributeClass = null)
	{
		if(!$attributeClass) {
			$attributeClass = 'Clio\Component\Attribute\SimpleAttribute';
		}

		if(!$attributeClass instanceof \ReflectionClass) {
			$attributeClass = new \ReflectionClass($attributeClass);
		}

		if(!$attributeClass->implementsInterface('Clio\Component\Attribute\Attribute')) {
			throw new \Clio\Component\Exception\InvalidArgumentException(sprintf('Class "%s" is not implement Attribute', $attributeClass->getName()));
		}
		parent::__construct($attributeClass);
	}

	/**
	 * createAttribute 
	 * 
	 * @param mixed $key 
	 * @param mixed $value 
	 * @param AttributeMapAware $owner 
	 * @access public
	 * @return void
	 */
	public function createAttribute($key, $value, $owner = null)
	{
		return $this->createComponent(array($key, $value, $owner));
	}
}

