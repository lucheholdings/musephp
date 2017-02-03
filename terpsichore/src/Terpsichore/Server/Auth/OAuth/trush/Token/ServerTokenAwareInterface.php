<?php
namespace Terpsichore\Server\Auth\OAuth\Token;

/**
 * ServerTokenAwareInterface
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
interface ServerTokenAwareInterface
{
	/**
	 * getServerToken 
	 * 
	 * @access public
	 * @return void
	 */
	function getServerToken();
}

