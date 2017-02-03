<?php
namespace Clio\Component\Auth\OAuth2\Exception;

/**
 * InvalidTokenException 
 * 
 * @uses Exception
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class InvalidTokenException extends InvalidRequestException
{
	const ERR_MESSAGE = 'invalid_token';
}

