<?php
namespace Clio\Component\Pce\FieldAccessor\Mapping;

/**
 * ClassMapping 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface ClassMapping
{
	/**
	 * getReflectionClass 
	 * 
	 * @access public
	 * @return void
	 */
	function getReflectionClass();

	/**
	 * getFields 
	 * 
	 * @access public
	 * @return void
	 */
	function getFields();
}

