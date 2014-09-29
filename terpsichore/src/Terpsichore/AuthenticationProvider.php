<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace ;

/**
 * Class 
 * 
 * @package ${ PACKAGE }
 * @subpackage 
 * @author ${ AUTHOR }
 */
class AuthenticationProvider 
{
	public function __construct()
	{
	}
}


$provider = new Service(
	'twitter',
	'oauth1',
	array(
		'client_id' => $clientId,
		'consumer_secret' => $consumerSecret,
	)
);

// Single Session Service
$service->authenticate(array($service::PARAM_USER_ID => $userId, $service::PARAM_PASSWORD => $password));
$userInfo = $service->getAuthneticatedUserInfo();


twitter:
	commands:
		authenticate:
			uri:    http://xxx.com/auth
			params:
				- user_id
				- 
		get_token:

class OAuthBridgeAuthenticationProvider
{
	private $serviceRegistry;

	public function authenticate()
	{
		$service = $this->getServiceRegistry()->get($provider);
		
		$builder = new AuthenticatedBuilder();
		$authenticated = $builder
			->buildFromAuthorizedHeader($authorizedHeader)
		;

		$service->setAuthentected($authenticated);
		$service->getAuthenticatedUserInfo();


	}
}
