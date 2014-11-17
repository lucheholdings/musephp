<?php
namespace Erato\Core\Model;

use Clio\Component\Util\Attribute\Attribute as AttributeInterface;

/**
 * Attribute 
 * 
 * @uses AbstractAttribute
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Attribute implements AttributeInterface
{
	/**
	 * owner 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $owner;

	/**
	 * key 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $key;

	/**
	 * value 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $value;
    
	/**
	 * __construct 
	 * 
	 * @param mixed $key 
	 * @param mixed $value 
	 * @param mixed $owner 
	 * @access public
	 * @return void
	 */
	public function __construct($key, $value, $owner = null)
	{
		$this->key = $key;
		$this->value = $value;
		$this->owner = $owner;
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
    public function setOwner($owner)
    {
        $this->owner = $owner;
        return $this;
    }
    
    /**
     * Get key.
     *
     * @access public
     * @return key
     */
    public function getKey()
    {
        return $this->key;
    }
    
    /**
     * Set key.
     *
     * @access public
     * @param key the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }
    
    /**
     * Get value.
     *
     * @access public
     * @return value
     */
    public function getValue()
    {
        return $this->value;
    }
    
    /**
     * Set value.
     *
     * @access public
     * @param value the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }
}
