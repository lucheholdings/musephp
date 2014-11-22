<?php
namespace Terpsichore\Core\Request;

use Terpsichore\Core\Request as RequestInterface;

/**
 * AbstractRequest 
 * 
 * @uses Request
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class Request implements RequestInterface
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

        return $this;
    }
}

