<?php
namespace Terpsichore\Core\Service;

use Terpsichore\Core\Client;

class AbstractClientService extends AbstractService implements ClientService
{
	private $name;

	private $client;
	
	public function setClient(Client $client)
	{
		$this->client = $client;
	}

	public function getClient()
	{
		return $this->client;
	}

    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
}

