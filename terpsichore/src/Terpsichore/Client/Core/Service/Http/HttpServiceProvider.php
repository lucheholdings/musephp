<?php
namespace Terpsichore\Client\Service\Http;

use Terpsichore\Client\Service\GenericClientServiceProvider;

/**
 * HttpServiceProvider 
 * 
 * @uses GenericClientServiceProvider
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class HttpServiceProvider extends GenericClientServiceProvider
{
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
		return $this->createRequest(
			array_merge(
				$headers,
				array(
					'uri' => $uri,
					'method' => $method,
				)
			),
			$body
		);
	}
}
