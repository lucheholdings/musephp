<?php
namespace Clio\Extra\Accessor\Field\Factory;

use Clio\Component\Accessor\Field;
use Clio\Component\Accessor\Field\Factory\AbstractFieldAccessorFactory;
use Clio\Extra\Accessor\Field\AttributeMapAccessor;
use Clio\Component\Attribute\AttributeAccessor,
	Clio\Component\Attribute\AttributeComponentFactory
;

/**
 * AttributeMapAccessorFactory 
 * 
 * @uses AbstractFieldAccessorFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class AttributeMapAccessorFactory extends AbstractFieldAccessorFactory
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
	public function createFieldAccessor(Field $field, array $options = array())
	{
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

		return new AttributeMapAccessor($this->createAttributeAccessor($attributeFactory));
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
	 * isSupportedField 
	 * 
	 * @param mixed $schema 
	 * @access public
	 * @return void
	 */
	public function isSupportedField(Field $field)
	{
		if(($field->getSchema() instanceof ReflectionClassAwarable) && ($field->getSchema()->isReflectionClassAwared())) {
			return $field->getSchema()->getReflectionClass()->implementsInterface('Clio\Component\Attribute\AttributeMapAware');
		}
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

