<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Service\Auth;


class FacebookProvider extends OAuth2Provider 
{
	protected function mapUserInfo(array $userinfo)
	{
		return new User();
	}
}

