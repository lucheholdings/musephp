<?php
namespace Clio\Component\Util\Accessor\Schema;

/**
 * ReflectionClassAwarable 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface ReflectionClassAwarable
{
	/**
	 * isReflectionClassAwared 
	 * 
	 * @access public
	 * @return void
	 */
	function isReflectionClassAwared();

	/**
	 * getReflectionClass 
	 * 
	 * @access public
	 * @return void
	 */
	function getReflectionClass();
}

