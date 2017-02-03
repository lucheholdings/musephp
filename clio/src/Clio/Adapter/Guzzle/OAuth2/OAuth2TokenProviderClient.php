<?php
namespace Clio\Adapter\Guzzle\OAuth2;

use Clio\Component\Auth\OAuth2\Token\Provider\ChainGrantTokenProviderInterface;
use Clio\Component\Auth\OAuth2\Token\Provider\TokeninfoTokenProviderInterface;
use Guzzle\Http\Client;

use Clio\Component\Auth\OAuth2\Exception as OAuth2Exceptions;
use Clio\Component\Auth\OAuth2\Token\ClientToken;
use Clio\Component\Auth\OAuth2\Token\ChainedToken;
use Clio\Component\Auth\OAuth2\Token\TokenInfo;

/**
 * OAuth2TokenProviderClient 
 * 
 * @uses Client
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class OAuth2TokenProviderClient extends Client 
  implements 
    ChainGrantTokenProviderInterface,
	TokeninfoTokenProviderInterface
{
	/**
	 * getToken 
	 * 
	 * @param array $params 
	 * @access public
	 * @return void
	 */
	public function getToken($params = array())
	{
		$req = $this->post($this->getTokenPath(), null, $params);

		$res = null;
		try{
			$res = $req->send();
		}catch(\Exception $ex) {
			if(406 === $ex->getResponse()->getStatusCode()) {
				throw new OAuth2Exceptions\InvalidTokenException('Failed to request AccessToken');
			}
			throw $ex;
		}

		$res = json_decode((string)$res->getBody(), true);
		return ClientToken::fromArray($res);
	}

	/**
	 * getTokeninfo 
	 * 
	 * @param mixed $token 
	 * @access public
	 * @return void
	 */
	public function getTokeninfo($token)
	{
		$req = $this->get($this->getTokeninfoPath(), null);
		
		$req->getQuery()->set('access_token', $token);

		$res = null;

		$res = $req->send();

		$res = json_decode((string)$res->getBody(), true);
		$info = TokenInfo::fromArray($res);
		$info->setToken($token);

		return $info;
	}

	/**
	 * getTokenWithTokeninfo 
	 * 
	 * @param mixed $token 
	 * @access public
	 * @return void
	 */
	public function getTokenWithTokeninfo($token)
	{
		$tokeninfo = $this->getTokeninfo($token);

		return $tokeninfo->createClientToken();
	}

	/**
	 * getTokenWithChainGrant 
	 * 
	 * @param mixed $token 
	 * @param array $params 
	 * @access public
	 * @return void
	 */
	public function getTokenWithChainGrant($token, array $scopes = array(), array $params = array())
	{
		if(!isset($params['client_id'])) {
			$params['client_id'] = $this->getClientId();
		}
		if(!isset($params['client_secret'])) {
			$params['client_secret'] = $this->getClientSecret();
		}

		$params['grant_type'] = 'chain';
		$params['access_token'] = $token;

		return new ChainedToken($this->getToken($params));
	}
    
    /**
     * getClientId 
     * 
     * @access public
     * @return void
     */
    public function getClientId()
    {
		return $this->getConfig('client_id');
    }
    
    /**
     * setClientId 
     * 
     * @param mixed $clientId 
     * @access public
     * @return void
     */
    public function setClientId($clientId)
    {
		$this->getConfig()->set('client_id',$clientId);
        return $this;
    }
    
    /**
     * getClientSecret 
     * 
     * @access public
     * @return void
     */
    public function getClientSecret()
    {
        return $this->getConfig('client_secret');
    }
    
    /**
     * setClientSecret 
     * 
     * @param mixed $clientSecret 
     * @access public
     * @return void
     */
    public function setClientSecret($clientSecret)
    {
        $this->getConfig()->set('client_secret', $clientSecret);
        return $this;
    }
    
    /**
     * getTokenPath 
     * 
     * @access public
     * @return void
     */
    public function getTokenPath()
    {
        return $this->getConfig('token_path');
    }
    
    /**
     * setTokenPath 
     * 
     * @param mixed $tokenPath 
     * @access public
     * @return void
     */
    public function setTokenPath($tokenPath)
    {
        $this->getConfig()->set('token_path', $tokenPath);
        return $this;
    }

	/**
	 * getTokeninfoPath 
	 * 
	 * @access public
	 * @return void
	 */
	public function getTokeninfoPath()
	{
		return $this->getConfig()->get('tokeninfo_path');
	}

	/**
	 * setTokeninfoPath 
	 * 
	 * @param mixed $path 
	 * @access public
	 * @return void
	 */
	public function setTokeninfoPath($path)
	{
		$this->getConfig()->set('tokeninfo_path', $path);
		return $this;
	}
}

