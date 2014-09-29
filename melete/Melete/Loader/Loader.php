<?php
namespace Melete\Loader;

/**
 * Loader 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Loader
{
	/**
	 * load 
	 * 
	 * @access public
	 * @return void
	 */
	function load($content);
}

