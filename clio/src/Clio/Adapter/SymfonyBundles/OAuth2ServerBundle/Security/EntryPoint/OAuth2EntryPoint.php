<?php
namespace Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Security\EntryPoint;

use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

/**
 * OAuth2EntryPoint 
 * 
 * @uses AuthenticationEntryPointInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class OAuth2EntryPoint implements AuthenticationEntryPointInterface
{
	public function start(Request $request, AuthenticationException $authException = null)
	{
		throw new UnauthorizedHttpException(null, 'Unauthorized', $authException);
	}
}

