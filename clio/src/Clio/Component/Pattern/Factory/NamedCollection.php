<?php
namespace Clio\Component\Pattern\Factory;

use Clio\Component\Exception\UnsupportedException;

use Clio\Component\Container\ArryaImpl\Map;

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
		return $this->doCreate($args);
	}

    /**
     * createByKey 
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
	public function createByKey($key)
	{
		return $this->doCreate(func_get_args());
	}

    /**
     * doCreate 
     * 
     * @param array $args 
     * @access protected
     * @return void
     */
	protected function doCreate(array $args = array())
	{
        $key = Util::shiftArg($args);
        return $this->getFactory($key)->createArgs($args);
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
}

