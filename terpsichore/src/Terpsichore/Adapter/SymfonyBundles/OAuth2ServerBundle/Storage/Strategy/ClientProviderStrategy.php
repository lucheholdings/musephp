<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage\Strategy;

/**
 * ClientProvider 
 * 
 * @uses StorageStrategy
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
interface ClientProviderStrategy extends StorageStrategy
{
    /**
     * findOneByClientId 
     * 
     * @param mixed $clientId 
     * @access public
     * @return ClientInterface
     */
    function findOneByClientId($clientId);
}
