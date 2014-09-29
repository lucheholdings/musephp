<?php
namespace Terpsichore\Core\Service;

use Terpsichore\Core\Auth\Provider as AuthenticationProvider;
/**
 * GenericSocialService
 *   GenericSocialService is a subclass of CompositeService which provides authentication/authorization flow
 *   for API access.
 *   Most Social provides OAuth for auth protocol, but GenericSocialService can also take Username/Password as well.
 *   
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class GenericSocialService extends CompositeService implements AuthenticationProvider
{
	public function authenticate()
	{
		$authService = $this->getAuthenticationService();

		return call_user_func_array(array($authService, 'authenticate'), func_get_args());
	}

	public function getAuthenticatedUserinfo(Authenticated $authenticated)
	{
		if(!$authenticated->isAuthenticated()) {
			throw new AuthenticationException(sprintf('The access to call GetAuthenticatedUserInfo on Service "%s" has to be authenticated.', $this->getName()));
		}
		$authService = $this->getAuthenticationService();

		return $authService->getAuthenticatedUserinfo($authenticated);
	}

	public function getAuthenticationService()
	{
		return $this->getService('auth');
	}
}
