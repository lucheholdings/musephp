<?php
namespace Terpsichore\Bundle\OAuth2ServerBundle\Storage\Strategy\Factory;

use Clio\Component\Util\Container\Collection\Collection;

/**
 * TypedStrategyFactory 
 * 
 * @uses Collection
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TypedStrategyFactory extends Collection 
{
	/**
	 * createTokenManager 
	 * 
	 * @param mixed $type 
	 * @param mixed $connectTo 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function createTokenManager($type, $connectTo, array $options = array())
	{
		$factory = $this->getTypeFactory($type);

		return $factory->createTokenManager($connectTo, $options);
	}

	/**
	 * createClientProvider 
	 * 
	 * @param mixed $type 
	 * @param mixed $connectTo 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function createClientProvider($type, $connectTo, array $options = array())
	{
		$factory = $this->getTypeFactory($type);

		return $factory->createClientProvider($connectTo, $options);
	}

	/**
	 * createUserProvider 
	 * 
	 * @param mixed $type 
	 * @param mixed $connectTo 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function createUserProvider($type, $connectTo, array $options = array())
	{
		$factory = $this->getTypeFactory($type);

		return $factory->createUserProvider($connectTo, $options);
	}


	/**
	 * setTypeFactory 
	 * 
	 * @param mixed $type 
	 * @param mixed $factory 
	 * @access public
	 * @return void
	 */
	public function setTypeFactory($type, $factory)
	{
		return $this->set($type, $factory);
	}

	/**
	 * getTypeFactory 
	 * 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	public function getTypeFactory($type)
	{
		return $this->get($type);
	}

	/**
	 * hasTypeFactory 
	 * 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	public function hasTypeFactory($type)
	{
		return $this->has($type);
	}
}

