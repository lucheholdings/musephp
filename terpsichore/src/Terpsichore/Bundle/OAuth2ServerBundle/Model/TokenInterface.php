<?php
namespace Terpsichore\Bundle\OAuth2ServerBundle\Model;

use Clio\Component\Auth\OAuth2\Token\ServerTokenInterface;
/**
 * TokenInterface 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
interface TokenInterface extends ServerTokenInterface
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
