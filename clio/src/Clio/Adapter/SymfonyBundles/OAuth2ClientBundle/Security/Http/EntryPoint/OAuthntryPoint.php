<?php
namespace Clio\Adapter\SymfonyBundles\OAuth2ClientBundle\Security\Http\EntryPoint;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;
use Symfony\Component\Security\Http\HttpUtils;
/**
 * OAuthEntryPoint 
 *   This entry point redirect to OAuth Authentication Server which return AUTHORIZATION CODE 
 *   when user accept.
 *   If you want to use "password" grant type, use "Symfony\Component\Security\Http\EntryPoint\FormAuthenticationEntryPoint" instead.
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
class OAuthEntryPoint implements AuthenticationEntryPointInterface
{
	/**
	 * httpUtils 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $httpUtils;

	/**
	 * redirectTo 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $redirectTo;
	
	/**
	 * __construct 
	 * 
	 * @param mixed $redirectTo 
	 * @param HttpUtils $utils 
	 * @access public
	 * @return void
	 */
	public function __construct($redirectTo, HttpUtils $utils)
	{
		$this->httpUtils = $utils;
		$this->redirectTo = $redirectTo;
	}

	/**
	 * start 
	 *   Redirect to Authentication Page 
	 * @param Request $request 
	 * @param AuthenticationException $exception 
	 * @access public
	 * @return void
	 */
	public function start(Request $request, AuthenticationException $exception = null)
	{
		return $this->httpUtils->createRedirectResponse($request, $this->redirectTo);
	}
}

