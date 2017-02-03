<?php
namespace Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Token;

use Symfony\Component\HttpFoundation\Request;
/**
 * Resolver 
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

