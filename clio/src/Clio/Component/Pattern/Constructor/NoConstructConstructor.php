<?php
namespace Clio\Component\Pattern\Constructor;

/**
 * NoConstructConstructor 
 *   Create instance without calling of constructor 
 * @uses Constructor
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class NoConstructConstructor implements Constructor
{
	/**
	 * getInstance 
	 *   Singleton of the Constructor.
	 * 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function getInstance()
	{
        static $_instance;
		if(!$_instance) {
			$_instance = new self();
		}

		return $_instance;
	}

	/**
	 * construct 
	 * 
	 * @param \ReflectionClass $class 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	public function construct(\ReflectionClass $class = null)
	{
        if(!$class) {
            throw new \InvalidArgumentException('Argument 1 of ConstructConstructor::construct has to be ReflectionClass.');
        }
		return $class->newInstanceWithoutConstructor();
	}
}

