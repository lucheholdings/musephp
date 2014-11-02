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
		return $this->doCreate(func_get_args());
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
}

