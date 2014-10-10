<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Client\Auth\OAuth\Token;

use Terpsichore\Client\Auth\Token\UserToken;

use Terpsichore\Client\Auth\User;

class OAuth1UserToken extends AbstractOAuth1Token implements UserToken
{
	/**
	 * user 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $user;
    
    public function getUser()
    {
        return $this->user;
    }
    
    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }
}

