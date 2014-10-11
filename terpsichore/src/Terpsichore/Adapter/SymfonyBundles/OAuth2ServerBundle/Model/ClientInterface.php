<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Model;


/**
 * ClientInterface 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
interface ClientInterface 
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
	 * getClientId 
	 * 
	 * @access public
	 * @return void
	 */
	function getClientId();

    /**
     * getClientSecret 
     * 
     * @access public
     * @return void
     */
    function getClientSecret();

    /**
     * setClientSecret 
     * 
     * @param mixed $secret 
     * @access public
     * @return void
     */
    function setClientSecret($secret);

    /**
     * checkClientSecret 
     * 
     * @param mixed $secret 
     * @access public
     * @return void
     */
    function checkClientSecret($secret);

    /**
     * setRedirectUris 
     * 
     * @param array $redirectUris 
     * @access public
     * @return void
     */
    function setRedirectUris(array $redirectUris);

    /**
     * getRedirectUris 
     * 
     * @access public
     * @return void
     */
    function getRedirectUris();

    /**
     * setAllowedGrantTypes 
     * 
     * @param array $grantTypes 
     * @access public
     * @return void
     */
    function setAllowedGrantTypes(array $grantTypes);

    /**
     * getAllowedGrantTypes 
     * 
     * @access public
     * @return void
     */
    function getAllowedGrantTypes();

	/**
	 * getSupportedScopes 
	 * 
	 * @access public
	 * @return void
	 */
	function getSupportedScopes();

	/**
	 * getDefaultScopes 
	 * 
	 * @access public
	 * @return void
	 */
	function getDefaultScopes();
}
