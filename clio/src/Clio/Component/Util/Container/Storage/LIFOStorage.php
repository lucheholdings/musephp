<?php
namespace Clio\Component\Util\Container\Storage;

use Clio\Component\Util\Container\Storage;

/**
 * LIFOStorage 
 * 
 * @uses StrageInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface LIFOStorage extends Storage
{
	/**
	 * push
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	function push($value);

	/**
	 * pop
	 * 
	 * @access public
	 * @return void
	 */
	function pop();

	/**
	 * top
	 * 
	 * @access public
	 * @return void
	 */
	function top();
}

