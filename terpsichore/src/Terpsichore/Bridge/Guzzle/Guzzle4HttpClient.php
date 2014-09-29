<?php
namespace Terpsichore\Bridge\Guzzle;

use Terpsichore\Core\Client\AbstractProxyClient;
use Terpsichore\Core\Client\Request;
use GuzzleHttp\Client as GuzzleClient;
/**
 * Guzzle4Client 
 *   Client to wrap Guzzle HttpClient. 
 * 
 * @uses AbtractHttpClient
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Guzzle4HttpClient extends AbstractProxyClient
{
	public function getClient()
	{
		$client = parent::getClient();

		if(!$client) {
			parent::setClient($client = new GuzzleClient());
		}

		return $client;
	}

	protected function doInitAuthentication()
	{
		$provider = $this->getAuthenticationProvider();

	}
	
	protected function validateClient($client)
	{
		return ($client instanceof GuzzleClient);
	}

	public function send(Request $request)
	{
		if(!$request->isPrepared()) {
			$request->prepare();
		}
		$request = $this->convertRequest($request);

		$response = $this->getClient()->send($request);
		
		$contentType = $response->getHeader('Content-Type');
		$contentType = explode(';', $contentType);
		$contentType = array_shift($contentType);

		switch($contentType) {
		case 'application/json':
		case 'text/javascript':
			return $response->json();
			break;
		case 'application/xml':
			return $response->xml();
			break;
		default:
			return $response; 
		}
	}

	protected function convertRequest(Request $request)
	{
		switch($request->getHeader('Content-Type')) {
		case 'application/json':
			$params = array('json' => $request->getContents());
			break;
		default:
			$params = array('body' => $request->getContents());
		}

		return $this->getClient()->createRequest(strtoupper($request->getMethod()), $request->getUrl(), array_merge($params, array('headers' => $request->getHeaders())));
	}
}

