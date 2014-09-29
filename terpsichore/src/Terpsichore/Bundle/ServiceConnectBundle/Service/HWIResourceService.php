<?php
namespace Terpsichore\Bundle\ServiceConnectBundle\Service;

use HWI\Bundle\OAuthBundle\OAuth\ResourceOwnerInterface;

use Terpsichore\Core\Service,
	Terpsichore\Core\Auth\Provider as AuthenticationProvider,
	Terpsichore\Core\Auth\Authenticated,
	Terpsichore\Core\Auth\OAuth;

class HWIResourceService implements Service, 
	AuthenticationProvider
{
	private $resourceOwner;

	public function __construct(ResourceOwnerInterface $resourceOwner)
	{
		$this->resourceOwner = $resourceOwner;
	}

	public function authenticate()
	{
		throw new \Exception('not impl');
	}

	public function getAuthenticatedUserInfo(Authenticated $token, array $options = array())
	{
		$tokens = array();

		if(($this->resourceOwner instanceof \HWI\Bundle\OAuthBundle\OAuth\ResourceOwner\GenericOAuth1ResourceOwner) && 
		   ($token instanceof OAuth\OAuth1Token)) 
		{
			// 
			return $this->resourceOwner->getUserInformation(array(
				'oauth_token' => $token->getOAuthToken(),
				'oauth_token_secret' => $token->getOAuthTokenSecret(),
			));
		} else if(( $this->resourceOwner instanceof \HWI\Bundle\OAuthBundle\OAuth\ResourceOwner\GenericOAuth2ResourceOwner) &&
			($token instanceof OAuth\OAuth2Token)) 
		{
			return $this->resourceOwner->getUserInformation(array('access_token' => $token->getAccessToken()));
		}

		throw new \InvalidArgumentException('Invalid match of ResourceOwner and Authenticated.');
	}

	public function getHWIResponsePaths()
	{
		$paths = array();
		{
			$obj = new \ReflectionObject($this->resourceOwner);
			$prop = $obj->getProperty('paths');
			$prop->setAccessible(true);
			$paths = $prop->getValue($this->resourceOwner);
		}
		return $paths;
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

	public function getName()
	{
		return 'hwi_resource_owner';
	}

	public function getAuthProtocol()
	{
		if($this->resourceOwner instanceof \HWI\Bundle\OAuthBundle\OAuth\ResourceOwner\GenericOAuth1ResourceOwner) {
			return 'oauth1';
		} else if($this->resourceOwner instanceof \HWI\Bundle\OAuthBundle\OAuth\ResourceOwner\GenericOAuth2ResourceOwner) {
			return 'oauth2';
		}

		return 'unknown';
	}

	public function createAuthenticated(array $params)
	{
		if($this->resourceOwner instanceof \HWI\Bundle\OAuthBundle\OAuth\ResourceOwner\GenericOAuth1ResourceOwner) {
			return OAuth\OAuth1Token::fromArray($params);
		} else if($this->resourceOwner instanceof \HWI\Bundle\OAuthBundle\OAuth\ResourceOwner\GenericOAuth2ResourceOwner) {
			return OAuth\OAuth2Token::fromArray($params);
		}

		return null;
	}
}

