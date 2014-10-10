<?php
namespace Terpsichore\Service\Facebook;

use Terpsichore\Client\Service\Http\GenericSocialServiceProvider;
use Terpsichore\Client\Auth\OAuth\GenericOAuth2Provider;
use Terpsichore\Client\Auth\Http\HttpAuthenticatedUserProvider;

/**
 * Facebook 
 * 
 * @uses GenericSocialServiceProvider
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
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
