<?php
namespace Clio\Framework\Accessor\Factory;

use Clio\Component\Util\Accessor\Factory\AbstractSchemaAccessorFactory;
use Clio\Framework\Accessor\AttributeContainerAccessor;
use Clio\Component\Util\Attribute\AttributeAccessor,
	Clio\Component\Util\Attribute\AttributeComponentFactory
;

/**
 * AttributeContainerAccessorFactory 
 * 
 * @uses AbstractSchemaAccessorFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class AttributeContainerAccessorFactory extends AbstractSchemaAccessorFactory
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
	public function createSchemaAccessor($schema, array $options = array())
	{
		if(!$schema->implementsInterface('Clio\Component\Util\Attribute\AttributeContainerAware')) {
			throw new \InvalidArgumentException(sprintf('Class "%s" is not implements AttributeContainerAware interface.', $schema->getName()));
		}


		// If attributeFactory is not initialize, then craete with attributeClass
		if($this->attributeFactory) {
			$attributeFactory = $this->getAttributeFactory();
		} else {
			$attributeClass = null;
			if(isset($options['attribute_class'])) {
				$attributeClass = $options['attribute_class'];
			}
			$attributeFactory = new AttributeComponentFactory($attributeClass);
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
	 * isSupportedSchema 
	 * 
	 * @param mixed $schema 
	 * @access public
	 * @return void
	 */
	public function isSupportedSchema($schema)
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

