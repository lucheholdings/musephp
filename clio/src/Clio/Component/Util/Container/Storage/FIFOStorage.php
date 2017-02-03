<?php
namespace Clio\Component\Util\Container\Storage;

use Clio\Component\Util\Container\Storage;
/**
 * FIFOStorage 
 * 
 * @uses Storage
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface FIFOStorage extends Storage
{
	/**
	 * enqueue 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	function enqueue($value);

	/**
	 * dequeue 
	 * 
	 * @access public
	 * @return void
	 */
	function dequeue();

	/**
	 * peek 
	 * 
	 * @access public
	 * @return void
	 */
	function peek();
}
