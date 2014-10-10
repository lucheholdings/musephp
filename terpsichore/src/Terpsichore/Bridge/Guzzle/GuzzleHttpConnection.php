<?php
namespace Terpsichore\Bridge\Guzzle;

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
		$request = $this->createGuzzleRequestFromRequest($request);

		$response = $this->getHttpClient()->send($request);

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
			return $response->getBody(); 
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
			$params['query'] = $resolver->resolveBody();
			break
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

