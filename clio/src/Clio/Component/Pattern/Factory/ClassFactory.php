<?php
namespace Clio\Component\Pattern\Factory;

/**
 * ClassFactory 
 * 
 * @uses Factory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ClassFactory extends AbstractFactory 
{
	/**
	 * doCreate 
	 * 
	 * @param array $args 
	 * @access protected
	 * @return void
	 */
	protected function doCreate(array $args = array())
	{
		$class = array_shift($args);
		return $this->createClass($class, $args);
	}

	/**
	 * createClass 
	 * 
	 * @param \ReflectionClass $class 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	public function createClass(\ReflectionClass $class, array $args = array())
	{
		$args = $this->resolveArgs($args);

		return $this->getConstructor()->construct($class, $args);
	}

	/**
	 * resolveArgs 
	 * 
	 * @param array $args 
	 * @access protected
	 * @return void
	 */
	protected function resolveArgs(array $args)
	{
		return $args;
	}
}

