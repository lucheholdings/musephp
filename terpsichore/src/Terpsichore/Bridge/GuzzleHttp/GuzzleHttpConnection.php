<?php
namespace Terpsichore\Bridge\GuzzleHttp;

use Terpsichore\Client\Connection\HttpConnection;
use Terpsichore\Client\Request;
use GuzzleHttp\Client as GuzzleClient;

/**
 * GuzzleHttpConnection 
 * 
 * @uses HttpConnection
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class GuzzleHttpConnection extends HttpConnection 
{
	/**
	 * client 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $client;

	/**
	 * __construct 
	 * 
	 * @param GuzzleClient $client 
	 * @access public
	 * @return void
	 */
	public function __construct(GuzzleClient $client = null)
	{
		$this->client = $client;
	}
    
    /**
     * getHttpClient 
     * 
     * @access public
     * @return void
     */
    public function getHttpClient()
    {
		if(!$this->client) {
			$this->client = new GuzzleClient();
		}
        return $this->client;
    }
    
    /**
     * setHttpClient 
     * 
     * @param GuzzleClient $client 
     * @access public
     * @return void
     */
    public function setHttpClient(GuzzleClient $client)
    {
        $this->client = $client;
        return $this;
    }

	/**
	 * send
	 * 
	 * @param Request $request 
	 * @access public
	 * @return void
	 */
	public function send(Request $request)
	{
		$guzzleRequest = $this->createGuzzleRequestFromRequest($request);

		try {
			$response = $this->getHttpClient()->send($guzzleRequest);
		} catch(\GuzzleHttp\Exception\ClientException $ex) {
			throw new GuzzleTransferException($this, $ex, $request);
		}

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
		case 'application/x-www-form-urlencoded':
			foreach(explode('&', (string)$response->getBody()) as $pair) {
				list($key, $value) = explode('=', $pair);

				$pairs[rawurldecode($key)] = rawurldecode($value);
			}
			return $pairs;
		default:
			return (string)$response->getBody();
		}
	}

	/**
	 * createGuzzleRequestFromRequest 
	 *   Convert Terpsichore Request to Guzzle's
	 * @param HttpRequest $request 
	 * @access protected
	 * @return GuzzleHttp\Requset
	 */
	protected function createGuzzleRequestFromRequest(Request $request)
	{
		$resolver = $this->getRequestResolver();

		$params = array();
		$method = $resolver->resolveMethod($request);

		switch($method) {
		case 'GET':
			$query = $resolver->resolveBody($request);
			if($query) {
				$params['query'] = $query;
			}
			break;
		default:
			switch($request->getHeader('content-type')) {
			case 'application/json':
				$params['json'] = $resolver->resolveBody($request);
				break;
			default:
				$params['body'] = $resolver->resolveBody($request);
				break;
			}
			break;
		}

		return $this->getHttpClient()->createRequest(
			$method,
			$resolver->resolveUri($request),
			array_merge(
				$params, 
				array('headers' => $resolver->resolveHeaders($request))
			));
	}
}
