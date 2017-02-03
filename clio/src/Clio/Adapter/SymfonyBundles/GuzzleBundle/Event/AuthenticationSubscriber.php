<?php
/****
 *
 * Description:
 *      
 * $Id$
 * $Date$
 * $Rev$
 * $Author$
 * 
 *  This file is part of the $Project$ package.
 *
 * $Copyrights$
 *
 ****/
namespace Clio\Symfony\Bundle\GuzzleBunle\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AuthenticationSubscriber implements EventSubscriberInterface 
{
	/**
	 * getSubscribedEvents 
	 * 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function getSubscribedEvents()
	{
		return array(
			'service_builder.create_client' => array('onClientCreate', 0)
		);
	}

	/**
	 * securityContext 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $securityContext;

	/**
	 * __construct 
	 * 
	 * @param mixed $securityAdapter 
	 * @access public
	 * @return void
	 */
	public function __construct($securityContext)
	{
		$this->securityContext = $secrutiyContext;
	}

	/**
	 * onClientCreate 
	 *   Event "service_builder.create_client"
	 * 
	 * @access public
	 * @return void
	 */
	public function onClientCreate($event)
	{
		$client = $event['client'];
		
		$plugin = false;
		// 
		if($this->securityContext->isGranted('IS_AUTHENTICATED_FULLY') && ($auth = $this->getAuthenticatedAuth())) {
			// get Authenticated Type
			$plugin = $this->getAuthenticationPlugin($auth, $this->securityContext->getToken());

		} else if($auth = $this->getDefaultAuth()) {
			$plugin = $this->getAuthenticationPlugin($auth);
		}
		
		if($plugin) {
			$client->addSubscriber($plugin);
		}
	}

	/**
	 * getAuthenticatedAuth 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function getAuthenticatedAuth()
	{
		return array_key_exists('authenticated', $this->auth) ?
			$this->auth['authenticated'] :
			false
		;
	}

	/**
	 * getDefaultAuth 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function getDefaultAuth()
	{
		return array_key_exists('default', $this->auth) ?
			$this->auth['default'] :
			false
		;
	}

	/**
	 * getAuthenticationPlugin 
	 * 
	 * @param array $auth 
	 * @param mixed $securityToken 
	 * @access protected
	 * @return void
	 */
	protected function getAuthenticationPlugin(array $auth, $securityToken = null)
	{
		// Use Default Authnetication
		switch($auth['type']) {
		case 'oauth':
			if($securityToken && ($securityToken instanceof OAuthTokenInterface)) {
				// 
			}
			break;
		case 'wsse':
			if($securityToken && ($securityToken instanceof WsseTokenInterface)) {
				// Get Security
			}
			$plugin = new WsseAuthPlugin();
			break;
		case 'basic':
			$plugin = new CurlAuthPlugin();
			break;
		default:
			break;
		}
	}
}
