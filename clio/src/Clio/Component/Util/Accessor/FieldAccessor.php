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
	const TYPE_GET      = 1;
	const TYPE_SET      = 2;
	const TYPE_IS_EMPTY = 3;
	const TYPE_CLEAR    = 4;
}

