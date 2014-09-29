<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Core\Auth\Provider;

use Clio\Component\Pattern\Factory\Factory;
use Terpsichore\Core\Auth\Token;

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

