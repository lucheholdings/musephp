<?php
namespace Terpsichore\Bundle\OAuth2ServerBundle\Security\Authentication\Token;

use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

use Clio\Component\Auth\OAuth2\Token\ServerTokenAwareInterface;
use Clio\Component\Auth\OAuth2\Token\ServerTokenInterface;
/**
 * OAuth2SecurityToken 
 * 
 * @uses AbstractToken
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class OAuth2SecurityToken extends AbstractToken
  implements
    ServerTokenAwareInterface
{
    /**
     * @var string
     */
    protected $token;

	/**
	 * escalatedRoles 
	 * 
	 * @var array
	 * @access protected
	 */
	protected $escalatedRoles = array();

    /**
     * setServerToken
     * 
     * @param mixed $token 
     * @access public
     * @return void
     */
    public function setServerToken(ServerTokenInterface $token)
    {
        $this->token = $token;
    }

    /**
     * getToken
     *   Return OAuth2 ServerToken 
     * @access public
     * @return void
     */
    public function getServerToken()
    {
        return $this->token;
    }

    /**
     * getCredentials 
     * 
     * @access public
     * @return void
     */
    public function getCredentials()
    {
        return $this->token;
    }

	/**
	 * getRoles 
	 *  
	 * @access public
	 * @return void
	 */
	public function getRoles()
	{
		// Get Default ROLEs as scopes 
		$roles = parent::getRoles();

		//
		if(!empty($this->escalatedRoles)) {
			$roles = array_unique(array_merge($roles, $this->userRoles));
		}

		return $roles;
	}

	/**
	 * escalateByUser 
	 *   Import and merge roles from ServiceUser
	 * @param UserInterface $user 
	 * @access public
	 * @return void
	 */
	public function escalateRolesByUser()
	{
		// Get user from access token
		if($user = $this->token->getUser()) {
			$roles = $user->getRoles();
			if(is_array($roles)) {
				$this->escalatedRoles = array_unique(array_merge($this->escalatedRoles, $roles));
			}
		}
	}
}
