<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Token\Resolver;

interface Factory
{
	/**
	 * createTokenResolver 
	 * 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	function createTokenResolver($type, array $options = array());
}

