<?php
namespace Clio\Component\Pattern\Constructor;

/**
 * Constructor 
 *   Constructor is to create new instance of specified ReflectionClass.
 *   Used to instantiate object.
 *   StaticMethodConstructor commonly used as Factory Pattern 
 *   ConstructorConstruct is as a defualt constructor 
 *  
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Constructor
{

	/**
	 * construct 
	 *   Constructor Strategy
	 *   
	 * @access public
	 * @return mixed instanceof the specified class
	 */
	function construct();
}

