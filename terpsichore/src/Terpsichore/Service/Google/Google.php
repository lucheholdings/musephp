<?php
namespace Terpsichore\Service\Google;

use Terpsichore\Core\Service\Http\GenericSocialServiceProvider;
use Terpsichore\Core\Auth\OAuth\GenericOAuth2Provider;
use Terpsichore\Core\Auth\Http\HttpAuthenticatedUserProvider;

class Google extends GenericSocialServiceProvider 
{
	/**
	 * init 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function init()
	{
		$this->setAuthenticationProvider(
			new GenericOAuth2Provider(
				'https://accounts.google.com/o/oauth2/token'
			)
		);
	
		$this->setAuthenticatedUserProvider(new HttpAuthenticatedUserProvider('https://www.googleapis.com/oauth2/v1/userinfo', array('method' => 'get'), array('id' => 'id', 'username' => 'email', 'email' => 'email')));
		
	}

	/**
	 * getName 
	 * 
	 * @access public
	 * @return void
	 */
	public function getName()
	{
		return 'google';
	}
}
