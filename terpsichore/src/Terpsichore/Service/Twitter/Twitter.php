<?php
namespace Terpsichore\Service\Twitter;

use Terpsichore\Core\Service\GenericSocialServiceProvider;
use Terpsichore\Core\Auth\OAuth\GenericOAuth1Provider;
use Terpsichore\Core\Auth\Http\HttpAuthenticatedUserProvider;

class Twitter extends GenericSocialServiceProvider 
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
			new GenericOAuth1Provider(
				'/oauth/access_token'
			)
		);
	
		$this->setAuthenticatedUserProvider(new HttpAuthenticatedUserProvider('https://api.twitter.com/1.1/account/verify_credentials.json', array('method' => 'get'), array('id' => 'id_str', 'username' => 'screen_name')));
		
	}

	/**
	 * getName 
	 * 
	 * @access public
	 * @return void
	 */
	public function getName()
	{
		return 'twitter';
	}
}
