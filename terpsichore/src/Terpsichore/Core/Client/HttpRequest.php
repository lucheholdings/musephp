<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Core\Client;
use Terpsichore\Core\Auth\Resolver\HttpAuthenticationResolver;


class HttpRequest extends AbstractRequest 
{
	/**
	 * url 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $url;

	/**
	 * method 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $method;

	/**
	 * headers 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $headers;

	/**
	 * httpAuthenticationResolver 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $httpAuthenticationResolver;

	/**
	 * __construct 
	 * 
	 * @param mixed $method 
	 * @param mixed $url 
	 * @access public
	 * @return void
	 */
	public function __construct($method, $url)
	{
		$this->method = $method;
		$this->url = $url;

		parent::__construct();
	}
	
	public function getHeaders()
	{
		return $this->headers;
	}

	public function setHeaders(array $headers)
	{
		$this->headers = $headers;

		$this->dirty();
		return $this;
	}

	public function prepare()
	{
		// pre-prepare.
		if(!$this->hasHeader('Content-Type')) {
			$this->setHeader('Content-Type', 'application/x-www-form-urlencoded');
		}

		// post-prepare
		$this->getHttpAuthenticationResolver()->resolveHeaders($this);
		$this->getHttpAuthenticationResolver()->resolveBody($this);

		parent::prepare();
	}

    
    public function getUrl()
    {
        return $this->url;
    }
    
    public function setUrl($url)
    {
        $this->url = $url;

		$this->dirty();
        return $this;
    }
    
    public function getMethod()
    {
        return $this->method;
    }
    
    public function setMethod($method)
    {
        $this->method = $method;

		$this->dirty();
        return $this;
    }

	public function hasHeader($key)
	{
		return isset($this->headers[$key]);
	}

	public function getHeader($key)
	{
		return $this->headers[$key];
	}

	public function setHeader($key, $value)
	{
		$this->headers[$key] = $value;

		$this->dirty();

		return $this;
	}
    
    public function getHttpAuthenticationResolver()
    {
		if(!$this->httpAuthenticationResolver) {
			$this->httpAuthenticationResolver = new HttpAuthenticationResolver();
		}
        return $this->httpAuthenticationResolver;
    }
    
    public function setHttpAuthenticationResolver(HttpAuthenticationResolver $httpAuthenticationResolver)
    {
        $this->httpAuthenticationResolver = $httpAuthenticationResolver;
        return $this;
    }
}

