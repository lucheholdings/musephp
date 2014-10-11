<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Model;

/**
 * TokenInterface 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
interface TokenInterface 
{

	/**
	 * setClientId 
	 * 
	 * @param mixed $clientId 
	 * @access public
	 * @return void
	 */
	function setClientId($clientId);

    /**
     * @param string $token
     */
    function setToken($token);

    /**
     * @param int $timestamp
     */
    function setExpiresAt(\DateTime $datetime);

    /**
     * @return int
     */
    function getExpiresAt();

    /**
     * @param string|null $scope
     */
    function setScopes($scopes);
}
