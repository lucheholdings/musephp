<?php
namespace Terpsichore\Bundle\OAuth2ServerBundle\Model;

use Clio\Component\Auth\OAuth2\Util\TokenUtil;

/**
 * Client 
 * 
 * @uses ClientInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
class Client implements ClientInterface
{
    /**
     * clientId 
     * 
     * @var string
     * @access protected
     */
    protected $clientId;

    /**
     * clientSecret 
     * 
     * @var string
     * @access protected
     */
    protected $clientSecret;

    /**
     * redirectUris 
     * 
     * @var array
     * @access protected
     */
    protected $redirectUris = array();

    /**
     * allowedGrantTypes 
     * 
     * @var arary
     * @access protected
     */
    protected $allowedGrantTypes;

	/**
	 * supportedScopes 
	 * 
	 * @var array
	 * @access protected
	 */
	protected $supportedScopes;

    public function __construct()
    {
		$this->supportedScopes = array();
		$this->redirectUris = array();
        $this->allowedGrantTypes = array(
            'authorization_code',
        );

        $this->setClientId(TokenUtil::generateRandomToken());
        $this->setClientSecret(TokenUtil::generateRandomToken());

    }

	/**
	 * getClientId 
	 * 
	 * @access public
	 * @return void
	 */
	public function getClientId()
	{
		return $this->clientId;
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
		$this->clientId = $clientId;
	}

    /**
     * {@inheritdoc}
     */
    public function setClientSecret($secret)
    {
        $this->clientSecret = $secret;
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
    public function checkClientSecret($secret)
    {
        return (null === $this->clientSecret || $secret === $this->clientSecret);
    }

    /**
     * {@inheritdoc}
     */
    public function setRedirectUris(array $redirectUris)
    {
        $this->redirectUris = $redirectUris;
    }

    /**
     * {@inheritdoc}
     */
    public function getRedirectUris()
    {
        return $this->redirectUris ? : array();
    }

    /**
     * {@inheritdoc}
     */
    public function setAllowedGrantTypes(array $grantTypes)
    {
        $this->allowedGrantTypes = $grantTypes;
    }

    /**
     * {@inheritdoc}
     */
    public function getAllowedGrantTypes()
    {
        return $this->allowedGrantTypes ?: array();
    }

	/**
	 * getSupportedScopes 
	 * 
	 * @access public
	 * @return void
	 */
	public function getSupportedScopes()
	{
		return $this->supportedScopes ?: array();
	}

	public function setSupportedScopes(array $supportedScopes)
	{
		$this->supportedScopes = $supportedScopes;
	}

	/**
	 * getDefaultScopes 
	 * 
	 * @access public
	 * @return void
	 */
	public function getDefaultScopes()
	{
		return $this->getSupportedScopes();
	}
}
