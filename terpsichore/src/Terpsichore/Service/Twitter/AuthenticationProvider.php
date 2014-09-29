<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Service\Twitter;

use Terpsichore\Core\Auth\OAuth\GenericOAuth1Provider;

class AuthenticationProvider extends GenericOAuth1Provider 
{
	protected function init()
	{
		$this
			->setUrls(array(
				'userinfo' => 'https://api.twitter.com/1.1/account/verify_credentials.json',
			))
			->setResponseMappers(array(
				'userinfo' => array(
					'id'       => 'id_str',
					'username' => 'creen_name',
				)
			))
		;
	}

	public function getName()
	{
		return 'twitter';
	}
}

