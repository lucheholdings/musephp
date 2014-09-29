<?php
namespace Calliope\Framework\Core\Model;

use Clio\Component\Util\Attribute\AttributeContainer;
use Clio\Component\Util\Attribute\AttributeContainerAware;
use Calliope\Framework\Core\Container\AttributeMap;

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
	protected $_attributes;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		$this->_attributes = new AttributeMap();
	}

    /**
     * Get attributes.
     *
     * @access public
     * @return _attributes
     */
    public function getAttributes()
    {
        return $this->_attributes;
    }
    
    /**
     * Set attributes.
     *
     * @access public
     * @param _attributes the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setAttributes(AttributeContainer $attributes)
    {
        $this->_attributes = $attributes;

		$this->_attributes->setOwner($this);
        return $this;
    }
}

