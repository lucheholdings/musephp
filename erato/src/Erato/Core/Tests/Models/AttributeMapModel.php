<?php
namespace Erato\Core\Tests\Models;

use Clio\Component\Util\Attribute\AttributeMapAware;
use Clio\Component\Util\Attribute\AttributeMap;
use Clio\Component\Util\Attribute\AttributeMap;

/**
 * AttributeMapModel 
 * 
 * @uses AttributeMapAware
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class AttributeMapModel implements AttributeMapAware 
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
    public function setAttributes(AttributeMap $attributes)
    {
        $this->attributes = $attributes;
        return $this;
    }
}

