<?php
namespace Terpsichore\Client\Auth\OAuth\Provider;

/**
 * TokenProvider 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface TokenProvider
{
	/**
	 * {@inheritdoc}
	 */
	function getAccessToken();
}

