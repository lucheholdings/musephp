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
	 * @param string|ReflectionClass $class 
	 * @access public
	 * @return void
	 */
	public function createClass($class)
	{
		$args = func_get_args();
		$class = array_shift($args);

		return $this->createClassArgs($class, $args);
	}

	/**
	 * createClassArgs 
	 * 
	 * @param mixed $class 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	public function createClassArgs($class, array $args = array())
	{
		if(!$class instanceof \ReflectionClass) {
			$class = new \ReflectionClass($class);
		}
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

	/**
	 * {@inheritdoc}
	 */
	public function isSupportedArgs(array $args = array())
	{
		return class_exists(array_shift($args));
	}
}

