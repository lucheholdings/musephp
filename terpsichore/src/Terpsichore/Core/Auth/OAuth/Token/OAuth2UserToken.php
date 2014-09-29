<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Core\Auth\OAuth\Token;

use Terpsichore\Core\Auth\Token\UserToken;

use Terpsichore\Core\Auth\User;

class OAuth2UserToken extends AbstractOAuth2Token implements UserToken
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

