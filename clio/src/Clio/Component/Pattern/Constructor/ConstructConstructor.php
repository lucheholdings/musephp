<?php
namespace Clio\Component\Pattern\Constructor;

/**
 * ConstructConstructor 
 * 
 * @uses Constructor
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ConstructConstructor implements Constructor
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
	public function construct(\ReflectionClass $class = null, array $args = array())
	{
        if(!$class) {
            throw new \InvalidArgumentException('Argument 1 of ConstructConstructor::construct has to be ReflectionClass.');
        }
        if($class->getConstructor()) {
    		return $class->newInstanceArgs($args);
        } else {
            return $class->newInstanceWithoutConstructor();
        }
	}
}

