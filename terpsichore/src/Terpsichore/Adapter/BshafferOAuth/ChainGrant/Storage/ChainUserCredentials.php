<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Adapter\BshafferOAuth\ChainGrant\Storage;

use Terpsichore\Core\Auth\Token;

/**
 * ChainUserCredentials 
 * 
 * @uses UserCredentials
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface ChainUserCredentials 
{
	/**
	 * getUserDetailsForChainToken 
	 *    
	 * @param Token $token 
	 * @access public
	 * @return array
	 */
	function getUserDetailsForChainToken(Token $token);
}

