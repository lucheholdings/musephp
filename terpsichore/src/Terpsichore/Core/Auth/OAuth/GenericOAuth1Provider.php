<?php
namespace Terpsichore\Core\Auth\OAuth;

use Terpsichore\Core\Auth\Token;
/**
 * GenericOAuth1Service 
 *    OAuth1 Authentication Service Client
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class GenericOAuth1Provider extends AbstractOAuthProvider
{
	protected function doAuthenticate(Token $token)
	{
		// 
		throw new \Exception('Not Impl');
	}
}

