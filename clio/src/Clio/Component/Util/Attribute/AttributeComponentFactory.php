<?php
namespace Clio\Component\Util\Attribute;

use Clio\Component\Pce\Construction\ComponentFactory;

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
			$attributeClass = 'Clio\Component\Util\Attribute\SimpleAttribute';
		}

		if(!$attributeClass instanceof \ReflectionClass) {
			$attributeClass = new \ReflectionClass($attributeClass);
		}

		if(!$attributeClass->implementsInterface('Clio\Component\Util\Attribute\Attribute')) {
			throw new \Clio\Component\Exception\InvalidArgumentException(sprintf('Class "%s" is not implement Attribute', $attributeClass->getName()));
		}
		parent::__construct($attributeClass);
	}

	/**
	 * createAttribute 
	 * 
	 * @param mixed $key 
	 * @param mixed $value 
	 * @param mixed $owner 
	 * @access public
	 * @return void
	 */
	public function createAttribute($key, $value, $owner = null)
	{
		return $this->doCreate(array($key, $value, $owner));
	}
}

