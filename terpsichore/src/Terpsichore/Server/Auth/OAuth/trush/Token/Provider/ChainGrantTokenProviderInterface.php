<?php
namespace Terpsichore\Server\Auth\OAuth\Token\Provider;

/**
 * ChainGrantTokenProviderInterface 
 *   Get ClientToken from TokenProvider with "chain" Grant 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
interface ChainGrantTokenProviderInterface extends TokenProviderInterface
{
	/**
	 * getTokenWithChainGrant 
	 * 
	 * @param ServerTokenInterface $token 
	 * @param array $scopes 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	function getTokenWithChainGrant($token, array $scopes = array(), array $options = array());
}

