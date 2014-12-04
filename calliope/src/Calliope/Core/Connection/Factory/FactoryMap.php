<?php
namespace Calliope\Core\Connection\Factory;

use Calliope\Core\Connection\Factory;
use Clio\Component\Pattern\Factory\NamedCollection as BaseFactory;
use Clio\Component\Util\Validator\SubclassValidator;

class FactoryMap extends BaseFactory 
{
	public function initFactory()
	{
		$this->getStorage()->setValueValidator(new SubclassValidator('Calliope\Core\Connection\Factory'));
	}

	/**
	 * setTypeConnectionFactory 
	 * 
	 * @param mixed $type 
	 * @param ConnectionFactoryInterface $factory 
	 * @access public
	 * @return void
	 */
	public function setConnectionFactory($type, Factory $factory)
	{
		$this->set($type, $factory);

		return $this;
	}

	/**
	 * hasType 
	 * 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	public function hasConnectionFactory($type)
	{
		return $this->has($type);
	}

	/**
	 * getTypes 
	 * 
	 * @access public
	 * @return void
	 */
	public function getTypes()
	{
		return $this->getKeys();
	}

	/**
	 * createTypeConnection 
	 * 
	 * @param mixed $type 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function createConnection($type, $connectTo, array $options = array())
	{
		$factory = null;

		if(!$this->hasConnectionFactory($type)) {
			throw new \RuntimeException(sprintf(
				'Connection Type "%s" is not registered.',
				$type
			));

		}
		$factory = $this->get($type);

		if(!$factory) {
			throw new \RuntimeException(sprintf('Factory cannot resolved for Connection Type "%s"', $type));
		}

		return $factory->createConnection($connectTo, $options);
	}
}

