<?php
namespace Terpsichore\Service\Facebook;

use Terpsichore\Core\Service\GenericSocialServiceProvider;
use Terpsichore\Core\Auth\OAuth\GenericOAuth2Provider;
use Terpsichore\Core\Auth\Http\HttpAuthenticatedUserProvider;

class Facebook extends GenericSocialServiceProvider 
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
				'https://graph.facebook.com/oauth/access_token'
			)
		);
	
		$this->setAuthenticatedUserProvider(new HttpAuthenticatedUserProvider('https://graph.facebook.com/me', array('method' => 'get'), array('id' => 'id', 'username' => 'username', 'email' => 'email')));
		
	}

	/**
	 * getName 
	 * 
	 * @access public
	 * @return void
	 */
	public function getName()
	{
		return 'facebook';
	}
}
