<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Security\User;

use Symfony\Component\Security\Core\User\UserInterface;

class OAuth2User implements UserInterface 
{
	const DEFAULT_ROLE = 'ROLE_USER';

	private $id;

	private $username;

	private $roles;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct($id = null)
	{
		$this->id = $id;
		$this->roles = array(static::DEFAULT_ROLE);
	}
    
    /**
     * Get id.
     *
     * @access public
     * @return id
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Set id.
     *
     * @access public
     * @param id the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    
    /**
     * Get username.
     *
     * @access public
     * @return username
     */
    public function getUsername()
    {
        return $this->username;
    }
    
    /**
     * Set username.
     *
     * @access public
     * @param username the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

	public function getRoles()
	{
		$roles = array(static::DEFAULT_ROLE);
		$roles = array_unique(array_merge($roles, array_values($this->roles)));

		return $roles;
	}

	public function setRoles(array $roles)
	{
		$this->roles = $roles;
		return $this;
	}

	public function getPassword()
	{
		return null;
	}

	public function getSalt()
	{
		return null;
	}

	public function eraseCredentials()
	{
	}
}
