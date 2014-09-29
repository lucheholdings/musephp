<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Service\Facebook;

use Terpsichore\Core\Auth\OAuth\GenericOAuth2Provider;

class AuthenticationProvider extends GenericOAuth2Provider 
{
	protected function init()
	{
		$this
			->setUrls(array(
				'userinfo' => 'https://graph.facebook.com/me', 
			))
			->setResponseMappers(array(
				'userinfo' => array(
					'id'       => 'id',
					'username' => 'username',
					'email'    => 'email',
				)
			))
		;
	}

	public function getName()
	{
		return 'facebook';
	}
}
