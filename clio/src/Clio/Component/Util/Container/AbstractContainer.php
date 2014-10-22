<?php
namespace Clio\Component\Util\Container;

/**
 * AbstractContainer 
 * 
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractContainer
{
	/**
	 * keyValidator 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $keyValidator;

	/**
	 * valueValidator 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $valueValidator;
	
	/**
	 * hasKeyValidator 
	 * 
	 * @access public
	 * @return void
	 */
	public function hasKeyValidator()
	{
		return (bool)$this->keyValidator;
	}
    
    /**
     * getKeyValidator 
     * 
     * @access public
     * @return void
     */
    public function getKeyValidator()
    {
        return $this->keyValidator;
    }
    
    /**
     * setKeyValidator 
     * 
     * @param mixed $keyValidator 
     * @access public
     * @return void
     */
    public function setKeyValidator($keyValidator)
    {
        $this->keyValidator = $keyValidator;
        return $this;
    }

	/**
	 * hasValueValidator 
	 * 
	 * @access public
	 * @return void
	 */
	public function hasValueValidator()
	{
		return (bool)$this->valueValidator;
	}
    
    /**
     * getValueValidator 
     * 
     * @access public
     * @return void
     */
    public function getValueValidator()
    {
        return $this->valueValidator;
    }
    
    /**
     * setValueValidator 
     * 
     * @param mixed $valueValidator 
     * @access public
     * @return void
     */
    public function setValueValidator($valueValidator)
    {
        $this->valueValidator = $valueValidator;
        return $this;
    }
}

