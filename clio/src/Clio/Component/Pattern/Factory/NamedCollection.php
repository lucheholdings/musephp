<?php
namespace Clio\Component\Pattern\Factory;

use Clio\Component\Exception\UnsupportedException;

use Clio\Component\Util\Container\Map\Map;
use Clio\Component\Util\Container\Storage as ContainerStorage;
use Clio\Component\Util\Validator\ClassValidator;

/**
 * NamedCollection 
 *   FactoryCollection supports two type of creation.
 * 
 *   - Create with "isSupportedArgs" guessing.
 *   - Create by Key as MappedFactory
 *
 * @uses Collection
 * @uses Factory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class NamedCollection extends Map implements MappedFactory, Factory 
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

		foreach($factories as $key => $factory) {
			$this->set($key, $factory);		
		}
	}

	/**
	 * {@inheritdoc}
	 */
	protected function initContainer(array $values)
	{
		parent::initContainer($values);
		if(!$this->getStorage() instanceof ContainerStorage\ValidatableStorage) {
			$this->setStorage(new ContainerStorage\ValidatableStorage($this->getStorage()));
		}
		$this->getStorage()->setValueValidator(new ClassValidator('Clio\Component\Pattern\Factory\Factory'));

		$this->initFactory();
	}

	/**
	 * initFactory 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function initFactory()
	{
			
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
		return $this->createByKeyArgs(array_shift($args), $args);
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
			throw new \InvalidArgumentException(sprintf('Factory "%s" is not existed.', $key));
		}

		$factory = $this->get($key);

		if($factory instanceof MappedFactory) {
			return $factory->createByKeyArgs($key, $args);
		}

		return $factory->createArgs($args);
	}

	/**
	 * isSupportedArgs 
	 * 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	public function isSupportedArgs(array $args = array())
	{
		return $this->isSupportedKeyArgs(array_shift($args), $args);
	}

	/**
	 * {@inheritdoc}
	 */
	public function isSupportedKeyArgs($key, array $args = array())
	{
		if(!$this->hasFactory($key)) {
			return false;
		}
		
		$factory = $this->getFactory($key);
		if($factory instanceof MappedFactory) {
			return $factory->isSupportedKeyArgs($key, $args);
		} else {
			return $factory->isSupportedArgs($args);
		}
	}

	/**
	 * getFactories 
	 * 
	 * @access public
	 * @return void
	 */
	public function getFactories()
	{
		return $this->toArray();
	}
	
	/**
	 * getFactory 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function getFactory($key)
	{
		return $this->get($key);
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

