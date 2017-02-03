<?php
namespace Clio\Framework\Metadata\Mapping;

use Clio\Component\Pce\Metadata\AbstractClassMapping;
use Clio\Component\Pce\Metadata\ClassMetadata;
use Clio\Component\Util\Attribute\AttributeAccessor;
use Clio\Component\Util\Attribute\AttributeComponentFactory;

/**
 * AttributeContainerAwareMapping 
 * 
 * @uses AbstractClassMapping
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class AttributeContainerAwareMapping extends AbstractClassMapping 
{
	/**
	 * attributeClass 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $attributeClass;

	/**
	 * _accessor 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $_accessor;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct($attributeClass = null)
	{
		if(!$attributeClass) {
			$attributeClass = 'Clio\Component\Util\Attribute\SimpleAttribute';
		}

		$this->attributeClass = $attributeClass;
	}
    
    /**
     * Get attributeClass.
     *
     * @access public
     * @return attributeClass
     */
    public function getAttributeClass()
    {
        return $this->attributeClass;
    }
    
    /**
     * Set attributeClass.
     *
     * @access public
     * @param attributeClass the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setAttributeClass($attributeClass)
    {
        $this->attributeClass = $attributeClass;
        return $this;
    }

	/**
	 * getAttributeAccessor 
	 * 
	 * @access public
	 * @return void
	 */
	public function getAttributeAccessor()
	{
		if(!$this->_accessor) {
			$this->_accessor = new AttributeAccessor(new AttributeComponentFactory($this->getAttributeClass()));
		}

		return $this->_accessor;
	}
}

