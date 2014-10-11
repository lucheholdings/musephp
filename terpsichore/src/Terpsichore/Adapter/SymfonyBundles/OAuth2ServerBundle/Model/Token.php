<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Model;

/**
 * Token 
 * 
 * @uses ServerToken
 * @uses TokenInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Token implements TokenInterface, \Serializable
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $clientId;

    /**
     * @var string
     */
    protected $token;

    /**
     * @var int
     */
    protected $expiresAt;

    /**
     * @var string
     */
    protected $scopes;

    /**
     * @var mixed
     */
    protected $userId;

	public function __construct()
	{
		$this->expiresAt = new \DateTime();
		$this->scopes = array();
	}

	/**
	 * getIdentifier 
	 * 
	 * @access public
	 * @return void
	 */
	public function getIdentifier()
	{
		return $this->getId();
	}

    /**
     * getId 
     * 
     * @access public
     * @return void
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function hasExpired()
    {
        if ($this->expiresAt) {
            $now = new \DateTime();
			
			return $now > $this->expiresAt;
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * {@inheritdoc}
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return $this->getUser();
    }

	public function serialize()
	{
		return serialize(array(
			$this->id,
			$this->clientId,
			$this->token,
			$this->expiresAt,
			$this->scopes,
			$this->userId,
		));
	}

	public function unserialize($serialized)
	{
		$data = unserialize($serialized);
		
		list(
			$this->id,
			$this->clientId,
			$this->token,
			$this->expiresAt,
			$this->scopes,
			$this->userId,
		) = $data;
	}

    
    /**
     * Get scopes.
     *
     * @access public
     * @return scopes
     */
    public function getScopes()
    {
        return $this->scopes;
    }
    
    /**
     * Set scopes.
     *
     * @access public
     * @param scopes the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setScopes($scopes)
    {
        $this->scopes = $scopes;
        return $this;
    }
    
    public function getClientId()
    {
        return $this->clientId;
    }
    
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
        return $this;
    }
    
    public function getToken()
    {
        return $this->token;
    }
    
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }
    
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }
    
    public function setExpiresAt($expiresAt)
    {
        $this->expiresAt = $expiresAt;
        return $this;
    }

	/**
	 * getExpiresIn 
	 * 
	 * @access public
	 * @return void
	 */
	public function getExpiresIn()
	{
		return abs($this->expiresAt->getTimestamp() - time());
	}
}
