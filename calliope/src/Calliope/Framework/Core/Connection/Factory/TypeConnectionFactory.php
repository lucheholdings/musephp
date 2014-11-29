<?php
namespace Calliope\Framework\Core\Connection\Factory;

use Clio\Component\Pattern\Factory\NamedCollection;
use Clio\Component\Util\Validator\SubclassValidator;

/**
 * TypeConnectionFactory 
 * 
 * @uses CompositeFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TypeConnectionFactory extends NamedCollection
{
	public function initFactory()
	{
		$this->getStorage()->setValueValidator(new SubclassValidator('Calliope\Framework\Core\Connection\Factory\ConnectionFactoryInterface'));
	}

	/**
	 * setTypeConnectionFactory 
	 * 
	 * @param mixed $type 
	 * @param ConnectionFactoryInterface $factory 
	 * @access public
	 * @return void
	 */
	public function setTypeConnectionFactory($type, ConnectionFactoryInterface $factory)
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
	public function hasType($type)
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
	 * @param array $params 
	 * @access public
	 * @return void
	 */
	public function createTypeConnection($type, $connectTo, array $params = array())
	{
		$factory = null;

		if(!$this->hasType($type)) {
			throw new \RuntimeException(sprintf(
				'Type "%s" is not registered.',
				$type
			));

		}
		$factory = $this->get($type);

		if(!$factory) {
			throw new \RuntimeException(sprintf('Factory cannot resolved for type "%s"', $type));
		}

		return $factory->createConnection($connectTo, $params);
	}
}

