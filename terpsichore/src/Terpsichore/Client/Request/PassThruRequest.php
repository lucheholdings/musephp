<?php
namespace Terpsichore\Client\Request;

use Terpsichore\Client\Request;

/**
 * PassThruRequest 
 * 
 * @uses ProxyRequest
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class PassThruRequest implements ProxyRequest 
{
	/**
	 * request 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $request;


	public function __construct(Request $request)
	{
		$this->request = $request;
	}
    
    /**
     * getRequest 
     * 
     * @access public
     * @return void
     */
    public function getRequest()
    {
        return $this->request;
    }
    
    /**
     * setRequest 
     * 
     * @param mixed $request 
     * @access public
     * @return void
     */
    public function setRequest($request)
    {
        $this->request = $request;
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
		return $this->getRequest()->getBody();
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
		$this->getRequest()->setBody($body);
		return $this;
	}

	/**
	 * getHeaders 
	 * 
	 * @access public
	 * @return void
	 */
	public function getHeaders()
	{
		return $this->getRequest()->getHeaders();
	}

	/**
	 * setHeaders 
	 * 
	 * @param array $headers 
	 * @access public
	 * @return void
	 */
	public function setHeaders(array $headers)
	{
		$this->getRequest()->getHeaders($headers);
		return $this;
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
		$this->getRequest()->setHeader($name, $value);
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
		return $this->getRequest()->getHeader($name, $default);
	}

	/**
	 * isDirty 
	 * 
	 * @access public
	 * @return void
	 */
	public function isDirty()
	{
		return $this->getRequest()->isDirty();
	}

	/**
	 * clean 
	 * 
	 * @access public
	 * @return void
	 */
	public function clean()
	{
		return $this->getRequest()->clean();
	}
}

