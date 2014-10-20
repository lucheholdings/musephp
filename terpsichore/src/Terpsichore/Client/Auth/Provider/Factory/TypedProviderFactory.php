<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Client\Auth\Provider\Factory;

use Clio\Component\Pattern\Factory\MappedComponentFactory;
use Clio\Component\Pattern\Factory\InheritComponentFactory;
use Terpsichore\Client\Auth\Provider\ProviderFactory;
use Terpsichore\Client\Auth\Token;
use Terpsichore\Client\Client;

class TypedProviderFactory extends MappedComponentFactory implements ProviderFactory
{
	private $connection;

	public function __construct(Connection $connection = null, array $classes = array())
	{
		parent::__construct($classes);

		$this->defaultFactory = new InheritComponentFactory('\Terpsichore\Client\Auth\Provider');
	}

	/**
	 * createProvider 
	 * 
	 * @param mixed $type 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	public function createProvider($type, array $args = array())
	{
		$provider  = $this->createByKeyArgs($type, $args);

		return $provider;
	}

	/**
	 * createProviderForToken 
	 * 
	 * @param Token $token 
	 * @access public
	 * @return void
	 */
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

    public function getDefaultFactory()
    {
        return $this->defaultFactory;
    }
    
    public function setDefaultFactory($defaultFactory)
    {
        $this->defaultFactory = $defaultFactory;
        return $this;
    }

	protected function resolveArgs(array $args)
	{
		$pre = array();
		if(isset($args['uri'])) {
			$pre[0] = $args['uri'];

			unset($args['uri']);
		}
		return $pre + $args;
	}
}

