<?php
namespace Clio\Component\Pce\FieldAccessor\Factory;

use Clio\Component\Pce\FieldAccessor\Mapping\ClassMapping;
use Clio\Component\Pce\FieldAccessor\PropertyFieldCollectionAccessor;
use Clio\Component\Pce\FieldAccessor\Property\Factory\PropertyFieldAccessorFactory;
use Clio\Component\Pce\FieldAccessor\Property\IgnorePropertyFieldAccessor;
/**
 * PropertyFieldCollectionAccessorFactory 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class PropertyFieldCollectionAccessorFactory extends AbstractFieldAccessorFactory
{
	/**
	 * addDefaultFactories 
	 * 
	 * @param PropertyFieldCollectionAccessorFactory $container 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function addDefaultFactories(PropertyFieldCollectionAccessorFactory $container)
	{
		$container
			->addPropertyFieldAccessorFactory(new PropertyFieldAccessorComponentFactory('Clio\Component\Pce\FieldAccessor\Property\PublicPropertyFieldAccessor'))
			->addPropertyFieldAccessorFactory(new PropertyFieldAccessorComponentFactory('Clio\Component\Pce\FieldAccessor\Property\MethodPropertyFieldAccessor'))
		;

		return $container;
	}

	/**
	 * propertyFieldAccessorFactories 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $propertyFieldAccessorFactories;

	/**
	 * __construct 
	 * 
	 * @param array $factories 
	 * @access public
	 * @return void
	 */
	public function __construct(array $factories = array())
	{
		foreach($factories as $type => $factory) {
			$this->setPropertyFieldAccessorFactory($factory);
		}
	}

	/**
	 * createFieldAccessor 
	 * 
	 * @param ClassMapping $mapping 
	 * @access public
	 * @return void
	 */
	public function createFieldAccessor(ClassMapping $mapping)
	{
		$fieldCollection = new PropertyFieldCollectionAccessor($mapping);

		$factories = $this->getPropertyFieldAccessorFactories();

		// 
		foreach($mapping->getFields() as $field) {
			$fieldName = $field->getName();
			if($field->isIgnoreField()) {
				//
				$fieldCollection->addFieldAccessor(new IgnorePropertyFieldAccessor($mapping, $fieldName));
			} else if(!$field->isSkipField() && isset($factories[$field->getAccessType()])) {
				// 
				$fieldCollection->addFieldAccessor(
					$factories[$field->getAccessType()]
						->createPropertyFieldAccessor(
							$mapping,
							$fieldName
						)
				);
			} 
		}

		return $fieldCollection;
	}
    
    /**
     * Get propertyFieldAccessorFactories.
     *
     * @access public
     * @return propertyFieldAccessorFactories
     */
    public function getPropertyFieldAccessorFactories()
    {
        return $this->propertyFieldAccessorFactories;
    }
    
    /**
     * Set propertyFieldAccessorFactories.
     *
     * @access public
     * @param propertyFieldAccessorFactories the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setPropertyFieldAccessorFactories(array $factories)
    {
		$this->propertyFieldAccessorFactories = array();
		foreach($factories as $type => $factory) {
			$this->setPropertyFieldAccessorFactory($type, $factory);
		}
        return $this;
   	}

	/**
	 * addPropertyFieldAccessorFactory 
	 * 
	 * @param PropertyFieldAccessorFactory $factory 
	 * @access public
	 * @return void
	 */
	public function setPropertyFieldAccessorFactory($type, PropertyFieldAccessorFactory $factory)
	{
		$this->propertyFieldAccessorFactories[$type] = $factory;

		return $this;
	}
}

