<?php
namespace Terpsichore\Bridge\Buzz;

use Terpsichore\Client\Connection\HttpConnection;
use Terpsichore\Client\Request;

use Buzz\Client\ClientInterface as BuzzClient,
	Buzz\Client\Curl as BuzzCurl;
use Buzz\Message\Request as BuzzRequest;
use Buzz\Message\Response as BuzzResponse;
use Buzz\Util\Url;

/**
 * BuzzHttpConnection 
 * 
 * @uses HttpConnection
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class BuzzHttpConnection extends HttpConnection 
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
	 * @param BuzzClient $client 
	 * @access public
	 * @return void
	 */
	public function __construct(BuzzClient $client = null)
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
			$this->client = new BuzzCurl();
		}
        return $this->client;
    }
    
    /**
     * setHttpClient 
     * 
     * @param BuzzClient $client 
     * @access public
     * @return void
     */
    public function setHttpClient(BuzzClient $client)
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
		$request = $this->createBuzzRequestFromRequest($request);
		$response = new BuzzResponse(); 
		$this->getHttpClient()->send($request, $response);

		$contentType = $response->getHeader('Content-Type');
		$contentType = explode(';', $contentType);
		$contentType = array_shift($contentType);

		switch($contentType) {
		case 'application/json':
		case 'text/javascript':
			return json_decode($response->getContent(), true);
			break;
		case 'application/xml':
			return $response->toDomDocument();
			break;
		default:
			return $response->getContent(); 
		}
	}

	/**
	 * createBuzzRequestFromRequest 
	 *   Convert Terpsichore Request to Buzz's
	 * @param HttpRequest $request 
	 * @access protected
	 * @return BuzzHttp\Requset
	 */
	protected function createBuzzRequestFromRequest(Request $request)
	{
		$resolver = $this->getRequestResolver();

		switch($request->getHeader('content-type')) {
		case 'application/json':
			$params = array('json' => $resolver->resolveBody($request));
			break;
		default:
			$params = array('body' => $resolver->resolveBody($request));
		}

		$httpRequest = new BuzzRequest($resolver->resolveMethod($request));

		$url = new Url($resolver->resolveUri($request));
		$url->applyToRequest($httpRequest);
	
		$httpRequest->addHeaders($resolver->resolveHeaders($request));
		$httpRequest->setContent($resolver->resolveBody($request));

		return $httpRequest;
	}
}

