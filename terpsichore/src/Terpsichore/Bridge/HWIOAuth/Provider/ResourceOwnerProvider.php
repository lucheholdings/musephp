<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Bridge\HWIOAuth\Provider;

use Terpsichore\Core\Auth\Provider as AUthenticationProviderInterface;
use Terpsichore\Core\Auth\Token;

use HWI\Bundle\OAuthBundle\OAuth\ResourceOwnerInterface;
/**
 * ResourceOwnerProvider 
 * 
 * @uses AuthenticationProviderInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ResourceOwnerProvider implements AuthenticationProviderInterface 
{
	private $resourceOwner;

	public function __construct(ResourceOwnerInterface $resourceOwner)
	{
		$this->resourceOwner = $resourceOwner;
	}

	public function authenticate()
	{
		
	}

	public function getUserInfo(Token $token)
	{
		if($token instanceof ProxyToken) {
			$token = $token->getToken();
		}

		$response = $this->getResourceOwner()->getUserInformation($this->convertTokenToArray($token));
		
		
		return array(
			'id'  => $response->getUsername(),
			'nickname'  => $response->getNickname(),
			'realname'  => $response->getRealName(),
			'email'  => $response->getEmail(),
			'profile_picture'  => $response->getProfilePicture(),
		);
	}

	protected function convertTokenToArray(Token $token)
	{
		switch($token->getName()) {
		case 'oauth1':
			$params = array(
				'oauth_token' => $token->getToken(),
				'oauth_token_secret' => $token->getTokenSecret(),
			)
			break;
		case 'oauth2':
			$params = array(
				'access_token' => $token->getAccessToken(),
			)
			break;

		}
	}
    
    public function getResourceOwner()
    {
        return $this->resourceOwner;
    }
    
    public function setResourceOwner(ResourceOwnerInterface $resourceOwner)
    {
        $this->resourceOwner = $resourceOwner;
        return $this;
    }
}

