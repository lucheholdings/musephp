<?php
namespace Clio\Framework\Tests\Models;

use Clio\Component\Util\Attribute\AttributeContainerAware;
use Clio\Component\Util\Attribute\AttributeContainer;
use Clio\Component\Util\Attribute\AttributeMap;

/**
 * AttributeContainerModel 
 * 
 * @uses AttributeContainerAware
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class AttributeContainerModel implements AttributeContainerAware 
{
	/**
	 * attributes 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $attributes;

	public function __construct(array $data = array())
	{
		$this->attributes = new AttributeMap($data);
	}
    
    /**
     * getAttributes 
     * 
     * @access public
     * @return void
     */
    public function getAttributes()
    {
        return $this->attributes;
    }
    
    /**
     * setAttributes 
     * 
     * @param mixed $attributes 
     * @access public
     * @return void
     */
    public function setAttributes(AttributeContainer $attributes)
    {
        $this->attributes = $attributes;
        return $this;
    }
}

