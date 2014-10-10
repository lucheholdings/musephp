<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Client\Auth\Provider\Factory;

use Clio\Component\Pattern\Factory\CompositeTypedFactory;
use Clio\Component\Pattern\Factory\InheritComponentFactory;
use Terpsichore\Client\Auth\Provider\ProviderFactory;
use Terpsichore\Client\Auth\Token;
use Terpsichore\Client\Client;

class TypedProviderFactory extends CompositeTypedFactory implements ProviderFactory
{
	private $client;
	private $defaultFactory;

	public function __construct(Client $client, array $factories = array())
	{
		parent::__construct($factories);

		$this->client = $client;
		$this->defaultFactory = new InheritComponentFactory('\Terpsichore\Client\Auth\Provider');
	}

	public function createProvider($type, array $args)
	{
		$factory = $this->getFactory($type);

			
	}

	public function createProviderForToken(Token $token)
	{
		$provider = $token->getProvider();

		if($provider instanceof Provider) {
			return $provider;
		} else if(is_string($provider)) {
			return $this->createProvider($type);
		}

		throw new \InvalidArgumentException('Token is not initialized by provider.');
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
}

