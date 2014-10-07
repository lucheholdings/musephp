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
	static private $_instance = null;

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
		if(self::$_instance) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * construct 
	 * 
	 * @param \ReflectionClass $class 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	public function construct(\ReflectionClass $class, array $args = array())
	{
		return $class->newInstanceArgs($args);
	}
}

