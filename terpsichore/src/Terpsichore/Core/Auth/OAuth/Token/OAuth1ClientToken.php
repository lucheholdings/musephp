<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Core\Auth\OAuth\Token;

class OAuth1ClientToken extends OAuth1Token implements HttpClientToken 
{
	public function createFromAuthorizationHeader($header)
	{
		$matches = array();
		if(!preg_match('/^OAuth (?<token>.*?)$/i', $header, $matches)) {
			throw new \Exception('Invalid Authorization pattern.');
		}
		
		$tokens = array();
		$parts = explode(',', $matches['token']);
		$matches = array();
		foreach($parts as $t) {
			if(!preg_match('/(?P<key>\w+)\=\"(?P<value>.*?)\"/s', $t, $matches)) {
				continue;
			}
		
			$tokens[$matches['key']] = $matches['value'];
		}


		return new static(null, $tokens);
	}
	private $params;

	public function __construct($provider, array $params = array())
	{
		parent::__construct($provider);

		$this->params = $params;
	}
	
	public function getHttpAuthorizationHeaders()
	{
		return array(
			'Authorization' => 'OAuth ' . implode(',', $this->getAuthorizationHeaderValues()),
		);
	}

	public function getAuhorizationHeaderValues()
	{
		// check the required params are existed.
		// If not initialize the client.
		if(!isset($this->params['oauth_consumer_key'])) {
			throw new \Exception('OAuth consumer key is not specified.');
		}
		if(!isset($this->params['nonce'])) {
			$this->params['nonce'] = $this->getNonce();
		}

		$values = array_intersect_key(
			$this->params,
			array_flip($this->getAuthoriationKeys())
		);	

		return $values;
	}

	public function getSignature()
	{
		$signature = null;
		return $signature;
	}

	public function getAuhorizationKeys()
	{
		return array(
			'realm',
			'oauth_consumer_key',
			'oauth_nonce',
			'oauth_signature_method',
			'oauth_timestamp',
			'oauth_token',
			'oauth_version',
			'oauth_signature',
		);
	}
}

