<?php

/*
 * This file is part of the TerpsichoreOAuth2ServerBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Terpsichore\Bundle\OAuth2ServerBundle\Model;
use Clio\Component\Auth\OAuth2\Token\ServerToken;

class Token extends ServerToken implements TokenInterface, \Serializable
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
}
