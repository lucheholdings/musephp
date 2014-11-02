<?php
namespace Calliope\Framework\Core\Model;

use Clio\Component\Util\Attribute\AttributeContainer;
use Clio\Component\Util\Attribute\AttributeContainerAware;
use Calliope\Framework\Core\Container\AttributeMap;

use Clio\Bridge\DoctrineCollection\Container\Storage\DoctrineCollectionStorage;
/**
 * FlexibleModel 
 * 
 * @uses AttributeContainerAware
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class FlexibleModel extends Model implements AttributeContainerAware
{
	/**
	 * attributes 
	 * 
	 * @var mixed
	 * @access protected
	 */
	private $_attributes;

	/**
	 * attributes 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $attributes;

    /**
     * Get attributes.
     *
     * @access public
     * @return _attributes
     */
    public function getAttributeMap()
    {
		if(!$this->_attributes) {
			$this->_attributes = new AttributeMap(array(), new DoctrineCollectionStorage($this->attributes));
		}
        return $this->_attributes;
    }
    
    /**
     * Set attributes.
     *
     * @access public
     * @param _attributes the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setAttributeMap(AttributeContainer $attributes)
    {
        $this->_attributes = $attributes;
		$this->_attributes->setOwner($this);

		$this->attributes = $attributes->getRaw();
        return $this;
    }
    
    public function getAttributes()
    {
        return $this->attributes;
    }
    
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;

		$this->_attributes = null;
        return $this;
    }
}

