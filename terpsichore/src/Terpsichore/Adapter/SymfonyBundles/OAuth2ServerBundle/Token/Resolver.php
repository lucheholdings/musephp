<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Token;

use Symfony\Component\HttpFoundation\Request;
/**
 * Resolver 
 *   RequestTokenResolver is a strategic resolver for how to solve 
 *   the requested token. 
 * 
 *   If this server includes AuthenticationProvider, or can point the storage of AuthProvider,
 *   then use ServerResolver.
 *   
 *   If your ResourceProvider is separated with AuthProvider, and 
 *   your AuthProvider provides tokeninfo API, use TokeninfoResolver.
 * 
 *   If you just trust whatever the sent request, then use TrustedResolver.
 *   (still you can validate with UserProvider)
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Resolver
{
	/**
	 * resolveToken 
	 * 
	 * @param Request $request 
	 * @access public
	 * @return void
	 */
	function resolveToken(Request $request);
}

