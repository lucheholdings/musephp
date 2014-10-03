<?php
namespace Terpsichore\Service\Facebook;

class FacebookFeed extends ClientService
{
	public function request(Request $request)
	{
		$this->getParent()->request($request);
	}

	public function initCalls()
	{
		$this
			->addService('post', 'post')
		; 
	}

	public function post()
	{
		$request = new HttpRequest();

		return $this->request($request);
	}

	public function getName()
	{
		return 'feed';
	}
}

$service = new Facebook();
$service->call('feed.post', 'xxxxxxxxxx');

$services->feed->Post('xxxxxxx');

	public function addExtensionalService($service)
	{
		foreach($service->getServiceInvokers() as $name => $invoker) {
			$nameInService = $service->getName() . '.' .$name;

			$this->addServiceInvokers($nameInService, $invoker);
		}
	}

	public function call($name, $args = array())
	{
		$invoker = $this->getServiceInvoker($name);
		return $invoker->invokeArgs((array)$args);
	}
