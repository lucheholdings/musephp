<?php
namespace Clio\Component\Util\Accessor;

/**
 * FieldAccessor 
 *   FieldAccessor is an accessor for specified field on container 
 * @uses Accessor
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface FieldAccessor 
{
	const ACCESS_GET      = 1;
	const ACCESS_SET      = 2;
	const ACCESS_IS_EMPTY = 3;
	const ACCESS_CLEAR    = 4;

	/**
	 * isSupportMethod 
	 * 
	 * @param mixed $container 
	 * @param mixed $field 
	 * @param mixed $methodType 
	 * @access public
	 * @return void
	 */
	function isSupportMethod($container, $field, $methodType);

}

