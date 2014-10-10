<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Client\Auth\Provider;

use Clio\Component\Pattern\Factory\Factory;
use Terpsichore\Client\Auth\Token;

/**
 * ProviderFactory 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface ProviderFactory 
{
	/**
	 * createProvider 
	 * 
	 * @access public
	 * @return void
	 */
	function createForToken(Token $token);
}

