<?php
namespace Terpsichore\Core\Auth\Token;

use Terpsichore\Core\Auth\Token;
use Terpsichore\Core\Auth\User;

/**
 * UserToken 
 * 
 * @uses Token
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class UserToken extends PassThruToken
{
	/**
	 * user 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $user;

	/**
	 * __construct 
	 * 
	 * @param Token $token 
	 * @param User $user 
	 * @access public
	 * @return void
	 */
	public function __construct(Token $token, User $user)
	{
		$this->user = $user;

		parent::__construct($token);
	}

    /**
     * getUser 
     * 
     * @access public
     * @return void
     */
    public function getUser()
    {
        return $this->user;
    }
    
    /**
     * setUser 
     * 
     * @param mixed $user 
     * @access public
     * @return void
     */
    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }
}

