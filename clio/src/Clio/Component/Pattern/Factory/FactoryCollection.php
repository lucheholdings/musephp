<?php
namespace Clio\Component\Pattern\Factory;

use Clio\Component\Exception\UnsupportedException;
use Clio\Component\Util\Container\Collection\Collection;
use Clio\Component\Util\Container\Validator\ClassValidator;

/**
 * FactoryCollection 
 *   FactoryCollection supports two type of creation.
 * 
 *   - Create with "isSupportedFactory" guessing.
 *   - Create by Key as MappedFactory
 *
 * @uses Collection
 * @uses Factory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class FactoryCollection extends Collection implements MappedFactory, Factory 
{
	/**
	 * __construct 
	 *  
	 * @param array $factories instance of Factory or string as classname 
	 * @access public
	 * @return void
	 */
	public function __construct(array $factories = array())
	{
		parent::__construct();

		$this->initFactory();

		foreach($factories as $key => $factory) {
			$this->set($key, $factory);		
		}
	}

	/**
	 * initFactory 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function initFactory()
	{
		$this->setValueValidator(new ClassValidator('Clio\Component\Pattern\Factory\Factory'));
	}

	/**
	 * create 
	 * 
	 * @access public
	 * @return void
	 */
	public function create()
	{
		return $this->createArgs(func_get_args());
	}

	/**
	 * createArgs 
	 * 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	public function createArgs(array $args = array())
	{
		$instance = null;

		// Traverse each factory to create an instance
		foreach($this->getValues() as $factory) {
			if($factory->isSupportedFactory($args)) {
				$instance = $factory->createArgs($args);
				break;
			}
		}

		if(!$instance) {
			throw new UnsupportedException('Failed to create an instance. There are no supported factory to create.');
		}

		return $instance;
	}

	public function createByKey()
	{
		$args = func_get_args();
		$key = array_shift($args);

		return $this->createByKeyArgs($key, $args);
	}

	public function createByKeyArgs($key, array $args = array())
	{
		if(!$this->hasKey($key)) {
			throw new \InvalidArgumentException(sprintf('Factory "%s" is not exixsted.', $key));
		}

		$factory = $this->get($key);

		if($factory instanceof MappedFactory) {
			return $factory->createByKeyArgs($key, $args);
		}

		return $factory->createArgs($args);
	}

	/**
	 * isSupportedFactory 
	 * 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	public function isSupportedFactory(array $args = array())
	{
		foreach($this->getFactories() as $factory) {
			if($factory->isSupportedFactory($args)) {
				return true;
			}
		}

		return false;
	}

	/**
	 * getFactories 
	 * 
	 * @access public
	 * @return void
	 */
	public function getFactories()
	{
		return $this->getValues();
	}

	/**
	 * hasFactory 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function hasFactory($key)
	{
		return $this->hasKey($key);
	}
}

