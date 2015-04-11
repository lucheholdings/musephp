<?php
namespace Clio\Component\Pattern\Factory;

use Clio\Component\Exception\UnsupportedException;

use Clio\Component\Util\Container\Map\StorageMap;
use Clio\Component\Util\Container\Storage as ContainerStorage;
use Clio\Component\Util\Validator\SubclassValidator;

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
class NamedCollection extends StorageMap implements MappedFactory, Factory 
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
		$this->getStorage()->setValueValidator(new SubclassValidator('Clio\Component\Pattern\Factory\Factory'));

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
		return $this->createByKeyArgs($this->shiftArg($args), $args);
	}

	public function createByKey($key)
	{
		$args = func_get_args();
		$key = $this->shiftArg($args);

		return $this->createByKeyArgs($key, $args);
	}

	public function createByKeyArgs($key, array $args = array())
	{
		if(!$this->has($key)) {
			throw new \InvalidArgumentException(sprintf('Factory "%s" is not existed.', $key));
		}

		$factory = $this->get($key);

		if($factory instanceof MappedFactory) {
			return $factory->createByKeyArgs($key, $args);
		}

		return $this->doCreateFactoryArgs($factory, $args);
	}

	protected function doCreateFactoryArgs($factory, array $args = array())
	{
		return $factory->createArgs($args);
	}

	public function canCreate()
	{
		return $this->isSupportedArgs(func_get_args());
	}

	public function canCreateArgs(array $args = array())
	{
		return $this->canCreateByKey($this->shiftArg($args), $args);
	}

	/**
	 * {@inheritdoc}
	 */
	public function canCreateByKey($key)
	{
		if(!$this->hasFactory($key)) {
			return false;
		}
        
        $args = func_get_args();
        
		$factory = $this->getFactory($key);
		if($factory instanceof MappedFactory) {
			return call_user_func_array(array($factory, 'canCreateByKey'), $args);
		} else {
			return $factory->canCreateArgs($args);
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
		return $this->has($key);
	}

	public function shiftArg(array &$args, $aliasKey = null) 
	{
		// we try to use the aliasKey to grab the arg, iff aliasKey is specified
		if($aliasKey && array_key_exists($aliasKey, $args)) {
			$arg = $args[$aliasKey];
			unset($args[$aliasKey]);
		} else {
			// just shift arg
			$arg = array_shift($args);
		}

		return $arg;
	}
}

