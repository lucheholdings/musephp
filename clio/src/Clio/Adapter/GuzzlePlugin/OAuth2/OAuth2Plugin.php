<?php
namespace Clio\Adapter\GuzzlePlugin\OAuth2;

use Guzzle\Common\Event,
	Guzzle\Common\Collection
;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use Clio\Component\Auth\OAuth2\Token\ClientTokenInterface,
	Clio\Component\Auth\OAuth2\Token\AccessTokenTypes;
use Clio\Component\Auth\OAuth2\Token\Provider\TokenProviderInterface;
use Clio\Component\Auth\OAuth2\Exception as OAuth2Exception;

/**
 * OAuth2Plugin 
 * 
 * @uses EventSubscriberInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class OAuth2Plugin implements EventSubscriberInterface
{
	/**
	 * config 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $config;

	/**
	 * token 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $token;

	/**
	 * provider 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $provider;


	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(ClientTokenInterface $token = null, TokenProviderInterface $provider = null, array $config = array())
	{
		$this->token = $token;
		$this->provider = $provider;
		$this->config = Collection::fromConfig($config, array(
			), array(
				'client_id', 'client_secret'
			));
	}

	/**
	 * getToken 
	 * 
	 * @access public
	 * @return void
	 */
	public function getToken()
	{
		return $this->token;
	}

	/**
	 * setToken 
	 * 
	 * @param ClientTokenInterface $token 
	 * @access public
	 * @return void
	 */
	public function setToken(ClientTokenInterface $token)
	{
		$this->token = $token;
	}

	/**
	 * getTokenProvider 
	 * 
	 * @access public
	 * @return void
	 */
	public function getTokenProvider()
	{
		return $this->provider;
	}

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            'request.before_send' => array('onRequestBeforeSend', -1000),
			'request.exception' => array('onRequestException', 0),
        );
    }

    /**
     * Request before-send event handler
     *
     * @param Event $event Event received
     * @return array
     */
    public function onRequestBeforeSend(Event $event)
    {
		$request = $event['request'];

		if(!$token = $this->getToken()) {
			// Get AccessToken from Provider
			$this->authenticate();
		}
        $request->setHeader(
            'Authorization',
            $this->buildAuthorizationHeader($this->getToken())
        );
    }

    /**
     * Builds the Authorization header for a request
     *
     * @param array $authorizationParams Associative array of authorization parameters
     *
     * @return string
     */
    private function buildAuthorizationHeader(ClientTokenInterface $token)
    {
		$type = strtolower($token->getTokenType());
		switch($type) {
		case AccessTokenTypes::BEARER:
			$headerValue = 'Bearer '.$token->getAccessToken();
			break;
		default:
			throw new \Exception(sprintf('Type "%s" is not supported.', $type));
		}

		return $headerValue;
    }


	/**
	 * authentication 
	 * 
	 * @param array $configs 
	 * @access public
	 * @return void
	 */
	public function authenticate(array $configs = array())
	{
		$token = null;

		// Merge configuration wiht AuthenticationProvider Setting
		$configs = Collection::fromConfig($this->config->toArray(), $configs, array(
				'client_id', 'client_secret'
			));
		
		$token = $this->getToken();
		if (!$token) {
			$provider = $this->getTokenProvider();
			if($provider) {
				$token = $provider->getToken($configs->toArray());
			} else {
				throw new \Exception('Cannot authenticate without OAuth Token Provider setting.');
			}
		}

		if($token) {
			$this->setToken($token);
		}


		return $token;
	}

	/**
	 * onRequestException 
	 * 
	 * @param Event $event 
	 * @access public
	 * @return void
	 */
	public function onRequestException(Event $event)
	{
		//FIXME:  
		//$response = $event['exception'];
		//
		//if($response instanceof BadResponseException) {
		//	$message = 'Access Denied';
		//	// 
		//	$statusCode = $response->getStatusCode();
		//	//
		//	throw new OAuth2Exception\AuthenticationException($message, 0, $event['exception']);
		//}
	}
}

