<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Core\Auth\OAuth\Token;

use Terpsichore\Core\Auth\OAuth\OAuth1Token;
use Terpsichore\Core\Auth\Token\AbstractToken;

/**
 * AbstractOAuth1Token 
 * 
 * @uses OAuth1Token
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractOAuth1Token extends AbstractToken implements OAuth1Token
{
	/**
	 * type 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $type;

	/**
	 * token
	 *   access_token 
	 * @var mixed
	 * @access private
	 */
	private $token;

	/**
	 * tokenSecret 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $tokenSecret;

	/**
	 * {@inheritdoc}
	 */
	private $clientId;

	/**
	 * {@inheritdoc}
	 */
	private $clientSecret;

	/**
	 * nonce 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $nonce;

	/**
	 * timestamp 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $timestamp;

	/**
	 * verifier 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $verifier;

	/**
	 * signatureMethod 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $signatureMethod;

	/**
	 * realm 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $realm;

	public function __construct($provider)
	{
		parent::__construct($provider);

		$this->signatureMethod = self::SIGNATURE_METHOD_HMAC;	
	}

    /**
     * {@inheritdoc}
     */
    public function getToken()
    {
        return $this->token;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getClientId()
    {
        return $this->clientId;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;
        return $this;
    }
    
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }
    
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;
        return $this;
    }
    
    public function getType()
    {
        return $this->type;
    }
    
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

	public function isAuthenticated()
	{
		return !is_null($this->token);
	}

	public function getName()
	{
		return 'oauth1';
	}
    
    public function getTokenSecret()
    {
        return $this->tokenSecret;
    }
    
    public function setTokenSecret($tokenSecret)
    {
        $this->tokenSecret = $tokenSecret;
        return $this;
    }

	public function getConsumerKey()
	{
		return $this->getClientId();
	}

	public function setConsumerKey($key)
	{
		return $this->setClientId($key);
	}

	public function getConsumerSecret()
	{
		return $this->getClientSecret();
	}

	public function setConsumerSecret($secret)
	{
		return $this->setClientSecret($secret);
	}

	public function getNonce()
	{
		if(!$this->nonce) {
			// generace nonce.
			$this->init();
		}
		return $this->nonce;
	}

	public function getTimestamp()
	{
		if(!$this->timestamp) {
			$this->init();
		}
		return $this->timestamp;
	}

	protected function init()
	{
		$this->timestamp = time();
		$this->nonce = md5(microtime(true).uniqid('', true));
	}
    
    public function getVerifier()
    {
        return $this->verifier;
    }
    
    public function setVerifier($verifier)
    {
        $this->verifier = $verifier;
        return $this;
    }
    
    public function getSignatureMethod()
    {
        return $this->signatureMethod;
    }
    
    public function setSignatureMethod($signatureMethod)
    {
        $this->signatureMethod = $signatureMethod;
        return $this;
    }

	public function hasRealm()
	{
		return (bool)$this->realm;
	}
    
    public function getRealm()
    {
        return $this->realm;
    }
    
    public function setRealm($realm)
    {
        $this->realm = $realm;
        return $this;
    }
}

