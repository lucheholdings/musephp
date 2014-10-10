<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Client\Auth\OAuth;

use Terpsichore\Client\Auth\Token;

interface OAuthToken extends Token
{
	function getToken();

	//function getClientId();

	//function getClientSecret();
}

