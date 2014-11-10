<?php
namespace Clio\Component\Pattern\Factory;

use Clio\Component\Pattern\Constructor\Constructor,
	Clio\Component\Pattern\Constructor\ConstructConstructor
;

/**
 * AbstractFactory 
 * 
 * @uses Factory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractFactory implements Factory
{
	/**
	 * constructor 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $constructor;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
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
		return $this->doCreate($args);
	}

	/**
	 * doCreate 
	 *    
	 * @param array $args 
	 * @abstract
	 * @access public
	 * @return void
	 */
	abstract protected function doCreate(array $args);

	/**
	 * getConstructor 
	 * 
	 * @access public
	 * @return void
	 */
	public function getConstructor()
	{
		if(!$this->constructor){
			$this->constructor = new ConstructConstructor();
		}

		return $this->constructor;
	}

	/**
	 * setConstructor 
	 * 
	 * @param Constructor $constructor 
	 * @access public
	 * @return void
	 */
	public function setConstructor(Constructor $constructor)
	{
		$this->constructor = $constructor;
	}

	/**
	 * {@inheritdoc}
	 */
	public function isSupported()
	{
		return $this->isSupportedArgs(func_get_args());
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
		return true;
	}

	public function shiftArg(array &$args, $aliasKey = null, $default = null) 
	{
		// we try to use the aliasKey to grab the arg, iff aliasKey is specified
		if($aliasKey && array_key_exists($aliasKey, $args)) {
			$arg = $args[$aliasKey];
			unset($args[$aliasKey]);
		} else if(0 < count($args)) {
			// just shift arg
			$arg = array_shift($args);
		} else {
			$arg = $default;
		}

		return $arg;
	}
}

