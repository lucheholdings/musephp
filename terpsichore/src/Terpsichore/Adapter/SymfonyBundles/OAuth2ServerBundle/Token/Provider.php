<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Token;

interface TokenProvider
{
	function getTokenForRequestToken($token);
}
