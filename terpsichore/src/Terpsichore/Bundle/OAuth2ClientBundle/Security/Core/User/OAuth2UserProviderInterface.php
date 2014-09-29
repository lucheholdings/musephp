<?php
namespace Clio\Adapter\SymfonyBundles\OAuth2ClientBundle\Security\Core\User;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Clio\Component\Auth\OAuth2\Token\ClientTokenInterface;
	
/**
 * 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
interface OAuth2UserProviderInterface extends UserProviderInterface 
{
	function loadUserByAccessToken(ClientTokenInterface $token);
}

