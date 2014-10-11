<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Security\User;

interface OAuth2UserProviderInterface 
{
	/**
	 * loadUserByAccessToken 
	 * 
	 * @param mixed $token 
	 * @access public
	 * @return void
	 */
	function loadUserByAccessToken($token);
}

