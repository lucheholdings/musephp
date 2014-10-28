<?php
namespace Calliope\Framework\Core\Container;

use Clio\Component\Util\Container\Map\OnMemoryMap;
use Clio\Component\Util\Attribute\Attribute;
use Clio\Component\Util\Attribute\AttributeContainer;
use Clio\Component\Util\Attribute\AttributeContainerAware;

use Clio\Component\Util\Validator\PrimitiveTypeValidator,
	Clio\Component\Util\Validator\ClassValidator
;
/**
 * AttributeMap 
 * 
 * @uses ObjectMap
 * @uses AttributeContainer
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class AttributeMap extends OnMemoryMap implements AttributeContainer
{
	/**
	 * owner 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $owner;

	public function __construct()
	{
		$this->keyValidator = new PrimitiveTypeValidator('string');
		$this->valueValidator = new ClassValidator('Clio\Component\Util\Attribute\Attribute');
	}

	/**
	 * addAttribute 
	 * 
	 * @param mixed $key 
	 * @param Attribute $value 
	 * @access public
	 * @return void
	 */
	public function addAttribute(Attribute $value)
	{
		$this->set($value->getKey(), $value);
		return $this;
	}

	/**
	 * getAttribute 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function getAttribute($key)
	{
		return $this->get($key);
	}

	/**
	 * getAttributeValue 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function getAttributeValue($key)
	{
		return $this->getAttribute($key)->getValue();
	}
    
    /**
     * Get owner.
     *
     * @access public
     * @return owner
     */
    public function getOwner()
    {
        return $this->owner;
    }
    
    /**
     * Set owner.
     *
     * @access public
     * @param owner the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setOwner(AttributeContainerAware $owner)
    {
        $this->owner = $owner;
        return $this;
    }
}

