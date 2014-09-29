<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Service\Google;

use Terpsichore\Core\Auth\OAuth\GenericOAuth2Provider;

class AuthenticationProvider extends GenericOAuth2Provider 
{
	protected function init()
	{
		$this
			->setUrls(array(
				'userinfo' => 'https://www.googleapis.com/oauth2/v1/userinfo', 
			))
			->setResponseMappers(array(
				'userinfo' => array(
					'id'       => 'id',
					'username' => 'email',
					'email'    => 'email',
				)
			))
		;
	}

	public function getName()
	{
		return 'google';
	}
}
