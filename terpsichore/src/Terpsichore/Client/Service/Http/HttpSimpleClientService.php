<?php
namespace Terpsichore\Client\Service\Http;

use Terpsichore\Client\Service\GenericClientService;
use Terpsichore\Client\Service\CallableService;
use Terpsichore\Client\Request\ServiceRequest;

/**
 * HttpSimpleClientService 
 * 
 * @uses GenericClientService
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class HttpSimpleClientService extends GenericClientService implements CallableService 
{
	/**
	 * uri 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $uri;

	/**
	 * method 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $method;

	/**
	 * __construct 
	 * 
	 * @param mixed $uri 
	 * @param array $options 
	 * @param Connection $connection 
	 * @access public
	 * @return void
	 */
	public function __construct($uri, $method, array $options = array(), Connection $connection = null, $name = null)
	{
		$this->uri = $uri;
		$this->method = $method;

		parent::__construct($connection, $name, $options);
	}

	/**
	 * call 
	 * 
	 * @param mixed $body 
	 * @access public
	 * @return void
	 */
	public function call($contents = null)
	{
		$request = $this->createRequest($this->getRequestHeaders(), $contents);

		return $this->request($request);
	}

	/**
	 * getRequestHeaders 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function getRequestHeaders()
	{
		return array(
			'uri' => $this->uri,
			'method' => $this->getOption('method'),
		);
	}

	/**
	 * createHttpRequest 
	 * 
	 * @param mixed $uri 
	 * @param mixed $method 
	 * @param mixed $body 
	 * @param array $headers 
	 * @access public
	 * @return void
	 */
	public function createHttpRequest($uri, $method, $body = null, array $headers = array())
	{
		$request = $this->createRequest(
			array_replace(
				$headers,
				array(
					'uri' => $uri,
					'method' => $method
				)
			),
			$body
		);

		return $request;
	}
    
	/**
	 * getStrictOptions 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function getStrictOptions()
	{
		return array(
			'uri' => $this->getUri(),
			'method' => $this->getMethod(),
		);
	}

    /**
     * getMethod 
     * 
     * @access public
     * @return void
     */
    public function getMethod()
    {
        return $this->method;
    }
    
    /**
     * setMethod 
     * 
     * @param mixed $method 
     * @access public
     * @return void
     */
    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }
    
    /**
     * getUri 
     * 
     * @access public
     * @return void
     */
    public function getUri()
    {
        return $this->uri;
    }
    
    /**
     * setUri 
     * 
     * @param mixed $uri 
     * @access public
     * @return void
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
        return $this;
    }
}

