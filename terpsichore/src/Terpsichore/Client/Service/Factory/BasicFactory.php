<?php
namespace Terpsichore\Client\Service\Factory;

class ServiceFactory  
{
	public function createServiceWithClient($client)
	{
		$connection = $this->createClientConnection($client);
	}
}

