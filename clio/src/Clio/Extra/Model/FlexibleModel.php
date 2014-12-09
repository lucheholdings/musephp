<?php
namespace Clio\Extra\Model;

use Clio\Component\Util\Attribute\AttributeMap as AttributeMapInterface;
use Clio\Component\Util\Attribute\AttributeMapAware;
use Clio\Component\Util\Attribute\SimpleAttributeMap;

use Clio\Bridge\DoctrineCommon\Container\Storage\DoctrineCollectionStorage;
/**
 * FlexibleModel 
 * 
 * @uses AttributeMapAware
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class FlexibleModel extends Model implements AttributeMapAware
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
			$this->_attributes = new SimpleAttributeMap(array(), new DoctrineCollectionStorage($this->attributes));
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
    public function setAttributeMap(AttributeMapInterface $attributes)
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

