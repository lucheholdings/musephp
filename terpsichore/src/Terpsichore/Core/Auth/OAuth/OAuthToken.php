<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Core\Auth\OAuth;

use Terpsichore\Core\Auth\Token;

interface OAuthToken extends Token
{
	function getToken();

	function getClientId();

	function getClientSecret();
}

