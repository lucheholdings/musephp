<?php
namespace Terpsichore\Client\Service;

use Terpsichore\Client\Service;
use Terpsichore\Client\Request\ServiceRequest;
/**
 * AbstractService 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractService implements Service
{
	/**
	 * _name 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $_name;

	/**
	 * _options 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $_options;

	/**
	 * __construct 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function __construct($name, array $options = array())
	{
		$this->_name = $name;
		$this->_options = $options;
	}
    
    /**
     * getName 
     * 
     * @access public
     * @return void
     */
    public function getName()
    {
        return $this->_name;
    }
    
    /**
     * setName 
     * 
     * @param mixed $name 
     * @access public
     * @return void
     */
    public function setName($name)
    {
        $this->_name = $name;
        return $this;
    }
    
    /**
     * getOptions 
     * 
     * @access public
     * @return void
     */
    public function getOptions()
    {
        return $this->_options;
    }
    
    /**
     * setOptions 
     * 
     * @param mixed $options 
     * @access public
     * @return void
     */
    public function setOptions($options)
    {
        $this->_options = $options;
        return $this;
    }

	/**
	 * setOption 
	 * 
	 * @param mixed $key 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function setOption($key, $value)
	{
		$this->_options[$key] = $value;
	}

	/**
	 * getOption 
	 * 
	 * @param mixed $key 
	 * @param mixed $default 
	 * @access public
	 * @return void
	 */
	public function getOption($key, $default = null)
	{
		return isset($this->_options[$key]) ? $this->_options[$key] : $default;
	}

	/**
	 * hasOption 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function hasOption($key)
	{
		return isset($this->_options[$key]);
	}


	/**
	 * createRequest 
	 * 
	 * @param array $headers 
	 * @param mixed $body 
	 * @access public
	 * @return void
	 */
	public function createRequest(array $headers = array(), $body = null)
	{
		return new ServiceRequest($body, $headers);
	}
}

