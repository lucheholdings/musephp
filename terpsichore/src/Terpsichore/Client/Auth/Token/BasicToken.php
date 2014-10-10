<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Client\Auth\Token\Token;

/**
 * BasicToken 
 * 
 * @uses Token
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class BasicToken extends AbstractToken 
{
	/**
	 * username 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $username;

	/**
	 * password 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $password;
    
    /**
     * getUsername 
     * 
     * @access public
     * @return void
     */
    public function getUsername()
    {
        return $this->username;
    }
    
    /**
     * setUsername 
     * 
     * @param mixed $username 
     * @access public
     * @return void
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }
    
    /**
     * getPassword 
     * 
     * @access public
     * @return void
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    /**
     * setPassword 
     * 
     * @param mixed $password 
     * @access public
     * @return void
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

	public function getName()
	{
		return 'basic';
	}
}

