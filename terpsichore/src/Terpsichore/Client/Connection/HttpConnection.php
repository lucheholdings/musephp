<?php
namespace Terpsichore\Client\Connection;

use Terpsichore\Client\Request\Resolver\HttpRequestResolver;

/**
 * HttpConnection 
 * 
 * @uses Connection
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class HttpConnection extends AbstractConnection 
{
	/**
	 * requestResolver 
	 *    
	 * @var mixed
	 * @access protected
	 */
	protected $requestResolver;

	/**
	 * getRequestResolver 
	 * 
	 * @access public
	 * @return void
	 */
	public function getRequestResolver()
	{
		if(!$this->requestResolver) {
			$this->requestResolver = new HttpRequestResolver();
		}

		return $this->requestResolver;
	}

	/**
	 * setRequestResolver 
	 * 
	 * @param HttpRequestResolver $requestResolver 
	 * @access public
	 * @return void
	 */
	public function setRequestResolver(HttpRequestResolver $requestResolver)
	{
		$this->requestResolver = $requestResolver;

		return $this;
	}
}

