<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Core\Auth\Token;

/**
 * HttpClientToken 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class HttpClientToken extends ProxyToken
{
	/**
	 * getHttpAuthorizationHeaders 
	 *    Authorization related headers on http 
	 *    e.g)
	 *      HttpBasic:
	 *        - Authorization: Basic ...
	 *      OAuth1:
	 *        - Authorization: OAuth ...
	 * 
	 * @access public
	 * @return array
	 */
	public function getHttpAuthorizationHeaders(array $params = array())
	{
		$headers = array();
		$token = $this->getToken();

		if(!$token) {
			throw new \RuntimeException('Token is not initialize.');
		}

		switch(strtolower($token->getName())) {
		case 'basic':
			$headers = array(
				'Authorization' => 'Basic ' . base64_encode($token->getUsername() . ':' . $token->getPassword())
			);
			break;
		case 'oauth1':
			$tokens = array(
				'oauth_consumer_key'     => $token->getConsumerKey(),
				'oauth_nonce'     => $token->getNonce(),
				'oauth_signature_method' => $token->getSignatureMethod(),
				'oauth_timestamp' => $token->getTimestamp(),
				'oauth_token'     => $token->getAccessToken(),
				'oauth_version'     => $token->getVersion(),
				'oauth_signature' => $token->getSignature($params['url']),
			);
			
			$headers = array(
				'Authorization' => 'OAuth ' . implode(',', $tokens),
			);
			break;
		case 'oauth2':
			$headers = array(
				'Authorization' => sprintf('%s %s', ucfirst(strtolower($token->getType())), $token->getAccessToken()),
			);
			break;
		default:
			break;
		}

		return $headers;
	}
}

