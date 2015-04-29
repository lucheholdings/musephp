<?php
namespace Clio\Component\Pair;

/**
 * SimpleKeyValuePair 
 * 
 * @uses KeyValuePair
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class SimpleKeyValuePair implements KeyValuePair
{
	/**
	 * key 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $key;

	/**
	 * value 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $value;

	/**
	 * __construct 
	 * 
	 * @param mixed $key 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function __construct($key, $value)
	{
		$this->key = $key;
		$this->value = $value;
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

