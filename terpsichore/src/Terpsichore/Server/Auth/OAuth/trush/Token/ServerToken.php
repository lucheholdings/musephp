<?php
namespace Terpsichore\Server\Auth\OAuth\Token;

/**
 * ServerToken 
 * 
 * @uses ServerTokenInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ServerToken implements ServerTokenInterface
{
    /**
     * @var string
     */
    protected $clientId;

    /**
	 * OAuth request token
	 * 
     * @var string
     */
    protected $token;

    /**
	 * 
	 * 
     * @var int
     */
    protected $expiresAt;

    /**
     * @var string
     */
    protected $scopes = array();

	/**
	 * userId 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $userId;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		$this->expiresAt = new \DateTime();
		$this->scopes = array();
	}
    
    /**
     * Get clientId.
     *
     * @access public
     * @return clientId
     */
    public function getClientId()
    {
        return $this->clientId;
    }
    
    /**
     * Set clientId.
     *
     * @access public
     * @param clientId the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
        return $this;
    }
    
    /**
     * Get token.
     *
     * @access public
     * @return token
     */
    public function getToken()
    {
        return $this->token;
    }
    
    /**
     * Set token.
     *
     * @access public
     * @param token the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }
    
    /**
     * Get expiresAt.
     *
     * @access public
     * @return expiresAt
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }
    
    /**
     * Set expiresAt.
     *
     * @access public
     * @param expiresAt the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setExpiresAt(\DateTime $expiresAt)
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

	/**
	 * serialize 
	 * 
	 * @access public
	 * @return void
	 */
	public function serialize()
	{
		return serialize(array(
			$this->clientId,
			$this->token,
			$this->expiresAt,
			$this->scopes,
		));
	}

	/**
	 * unserialize 
	 * 
	 * @param mixed $serialized 
	 * @access public
	 * @return void
	 */
	public function unserialize($serialized)
	{
		$data = unserialize($serialized);
		list(
			$this->clientId,
			$this->token,
			$this->expiresAt,
			$this->scopes,
		) = $data;
	}
    
    public function getUserId()
    {
        return $this->userId;
    }
    
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }
}

