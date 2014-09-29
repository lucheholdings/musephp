<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Service\Common;

class GenericSocialService 
{
	private $authenteService;

	private $services;

	public function __construct()
	{
	}

	public function authenticate()
	{
		$authenticateService = $this->getAuthenteService();
		$this->session->setAuthenticated($authenticateService->authenticate());

		return true;
	}
	
	/**
	 * __call 
	 *    E.g)
	 *      // Get the Service from Registry
	 *      $service = $serviceRegistry->get('twitter');
	 *      $service->tweet('Foo Bar');
	 * 
	 * @param mixed $method 
	 * @param mixed $args 
	 * @access public
	 * @return void
	 */
	public function __call($method, $args)
	{
		// 
		$service = $this->getCommandServiceFor($method);

		return call_user_func_array(array($service, $method), array_merge(array($this->getSession()), $args));
	}
}

