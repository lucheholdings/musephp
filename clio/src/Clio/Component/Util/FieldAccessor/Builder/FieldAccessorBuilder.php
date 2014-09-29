<?php
namespace Clio\Component\Util\FieldAccessor\Builder;

use Clio\Component\Util\FieldAccessor\Mapping\ClassMapping;

/**
 * FieldAccessorBuilder
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface FieldAccessorBuilder
{
	/**
	 * setClassMapping 
	 * 
	 * @param ClassMapping $classMapping 
	 * @access public
	 * @return void
	 */
	function setClassMapping(ClassMapping $classMapping);

	/**
	 * build 
	 * 
	 * @access public
	 * @return void
	 */
	function build();
}

