<?php
namespace Terpsichore\Bundle\OAuth2ServerBundle\Storage\Strategy;

/**
 * TokenManager 
 * 
 * @uses StorageStrategy
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
interface TokenManagerStrategy extends StorageStrategy
{
	/**
	 * createToken 
	 * 
	 * @access public
	 * @return Model\TokenInterface
	 */
	function createToken();

    /**
     * findOneByToken 
     * 
     * @param mixed $token 
     * @access public
     * @return Model\TokenInterface
     */
    function findOneByToken($token);
}
