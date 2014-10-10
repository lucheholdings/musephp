<?php
namespace Terpsichore\Client\Request;

use Terpsichore\Client\Request;

/**
 * ServiceRequest 
 * 
 * @uses Request
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ServiceRequest implements Request
{
	/**
	 * header 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $headers;

	/**
	 * body 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $body;

	/**
	 * dirty 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $dirty;

	/**
	 * __construct 
	 * 
	 * @param mixed $body 
	 * @param mixed $header 
	 * @access public
	 * @return void
	 */
	public function __construct($body = null, array $headers = array())
	{
		$this->headers = $headers;
		$this->body = $body;
		$this->dirty = true;
	}
    
    /**
     * getHeader 
     * 
     * @access public
     * @return void
     */
    public function getHeaders()
    {
        return $this->headers;
    }
    
    /**
     * setHeader 
     * 
     * @param mixed $header 
     * @access public
     * @return void
     */
    public function setHeaders(array $headers)
    {
        $this->headers = array();
		foreach($headers as $name => $value) {
			$this->setHeader($name, $value);
		}

        return $this;
    }

	/**
	 * getHeader 
	 * 
	 * @param mixed $name 
	 * @param mixed $default 
	 * @access public
	 * @return void
	 */
	public function getHeader($name, $default = null)
	{
		$name = strtolower($name);
		return isset($this->headers[$name]) ? $this->headers[$name] : $default;
	}

	/**
	 * setHeader 
	 * 
	 * @param mixed $name 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function setHeader($name, $value)
	{
		$this->headers[strtolower($name)] = $value;

		$this->dirty();

		return $this;
	}
    
    /**
     * getBody 
     * 
     * @access public
     * @return void
     */
    public function getBody()
    {
        return $this->body;
    }
    
    /**
     * setBody 
     * 
     * @param mixed $body 
     * @access public
     * @return void
     */
    public function setBody($body)
    {
        $this->body = $body;

		$this->dirty();

        return $this;
    }

	/**
	 * isDirty 
	 * 
	 * @access public
	 * @return void
	 */
	public function isDirty()
	{
		return $this->dirty;
	}

	/**
	 * dirty 
	 * 
	 * @access public
	 * @return void
	 */
	public function dirty()
	{
		$this->dirty = true;
	}

	/**
	 * clean 
	 * 
	 * @access public
	 * @return void
	 */
	public function clean()
	{
		$this->dirty = false;
	}
}

