<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Core\Auth\Provider\Factory;

use Clio\Component\Pattern\Factory\CompositeTypedFactory;
use Clio\Component\Pattern\Factory\InheritComponentFactory;
use Terpsichore\Core\Auth\Provider\ProviderFactory;
use Terpsichore\Core\Auth\Token;
use Terpsichore\Core\Client;

class TypedProviderFactory extends CompositeTypedFactory implements ProviderFactory
{
	private $client;
	private $defaultFactory;

	public function __construct(Client $client, array $factories = array())
	{
		parent::__construct($factories);

		$this->client = $client;
		$this->defaultFactory = new InheritComponentFactory('\Terpsichore\Core\Auth\Provider');
	}
	public function createForToken(Token $token)
	{
		return $this->createByType($token->getProvider());
	}

	protected function doCreateByType($type, array $args)
	{
		$factory = $this->getFactory($type);

		if(is_string($factory)) {
			$provider = $this->getDefaultFactory()->createInheritClassArgs($factory, $args);
		} else {
			$provider = parent::doCreateByType($type);
		}

		if($this->client) {
			$provider->setClient($this->client);
		}
		return $provider;
	}
    
    public function getDefaultFactory()
    {
        return $this->defaultFactory;
    }
    
    public function setDefaultFactory($defaultFactory)
    {
        $this->defaultFactory = $defaultFactory;
        return $this;
    }
    
    public function getClient()
    {
        return $this->client;
    }
    
    public function setClient($client)
    {
        $this->client = $client;
        return $this;
    }
}

