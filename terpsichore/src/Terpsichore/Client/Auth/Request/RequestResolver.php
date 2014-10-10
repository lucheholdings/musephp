<?php
namespace Terpsichore\Client\Auth\Request;

use Terpsichore\Client\Request;
use Terpsichore\Client\Auth\Token;

/**
 * RequestResolver 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface RequestResolver
{
	/**
	 * resolveRequest 
	 *   Resolve Request with the specified token. 
	 * @param Request $request 
	 * @param Token $token 
	 * @access public
	 * @return void
	 */
	function resolveRequest(Request $request, Token $token);
}

