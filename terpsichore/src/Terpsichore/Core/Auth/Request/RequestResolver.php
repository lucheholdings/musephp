<?php
namespace Terpsichore\Core\Auth\Request;

use Terpsichore\Core\Request;
use Terpsichore\Core\Auth\Token;

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

