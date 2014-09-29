<?php
namespace Terpsichore\Core\Auth\OAuth;

/**
 * OAuth1Token 
 * 
 * @uses Token
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface OAuth1Token extends OAuthToken
{
	const SIGNATURE_METHOD_PLAINTEXT = 'PLAINTEXT';
	const SIGNATURE_METHOD_HMAC      = 'HMAC-SHA1';
	const SIGNATURE_METHOD_RSA       = 'RSA';

	function getTokenSecret();

	function getNonce();
}

